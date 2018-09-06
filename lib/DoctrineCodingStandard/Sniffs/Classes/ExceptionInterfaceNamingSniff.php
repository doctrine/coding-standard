<?php

declare(strict_types=1);

namespace DoctrineCodingStandard\Sniffs\Classes;

use DoctrineCodingStandard\Helpers\UseStatementHelper;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use SlevomatCodingStandard\Helpers\TokenHelper;
use const T_EXTENDS;
use const T_INTERFACE;
use const T_OPEN_CURLY_BRACKET;
use function array_combine;
use function array_map;
use function count;
use function explode;
use function preg_grep;
use function preg_match;
use function trim;

final class ExceptionInterfaceNamingSniff implements Sniff
{
    private const CODE_NOT_AN_EXCEPTION = 'NotAnException';

    /**
     * @return int[]
     */
    public function register() : array
    {
        return [T_INTERFACE];
    }

    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     * @param int $pointer
     */
    public function process(File $phpcsFile, $pointer) : void
    {
        $importedClassNames = UseStatementHelper::getUseStatements($phpcsFile);
        $extendedInterfaces = $this->parseExtendedInterfaces($phpcsFile, $pointer);

        // Set original classname instead of alias
        $extendedInterfaces = array_map(function (string $extendedInterface) use ($importedClassNames) : string {
            return $importedClassNames[$extendedInterface] ?? $extendedInterface;
        }, $extendedInterfaces);

        $endsWithExceptionSuffix = preg_match('/Exception$/', (string) $phpcsFile->getDeclarationName($pointer)) === 1;

        $isExtendingThrowable = UseStatementHelper::isImplementingThrowable($importedClassNames, $extendedInterfaces);

        // Expects that an interface with the suffix "Exception" is a valid exception interface
        $isExtendingException = count(preg_grep('/Exception$/', $extendedInterfaces)) > 0;

        if ($endsWithExceptionSuffix && ($isExtendingException || $isExtendingThrowable)) {
            return;
        }

        if (! $endsWithExceptionSuffix && ! $isExtendingException && ! $isExtendingThrowable) {
            return;
        }

        if ($endsWithExceptionSuffix && ! $isExtendingException && ! $isExtendingThrowable) {
            $phpcsFile->addError(
                'Interface must extend an exception interface',
                $pointer,
                self::CODE_NOT_AN_EXCEPTION
            );

            return;
        }

        $phpcsFile->addError(
            'Exception interface must end with "Exception" name suffix',
            $pointer,
            self::CODE_NOT_AN_EXCEPTION
        );
    }

    /**
     * @return string[]
     */
    private function parseExtendedInterfaces(File $phpcsFile, int $stackPtr) : array
    {
        $limit = TokenHelper::findNext($phpcsFile, [T_OPEN_CURLY_BRACKET], $stackPtr) - 1;
        $start = TokenHelper::findNext($phpcsFile, [T_EXTENDS], $stackPtr + 1, $limit);

        if ($start === null) {
            return [];
        }

        $extendedInterfaces = explode(',', $phpcsFile->getTokensAsString($start + 1, $limit - $start));

        $extendedInterfaces = array_map('trim', $extendedInterfaces);
        $interfaceNames     = array_map(function ($interfaceName) : string {
            return trim($interfaceName, '\\');
        }, $extendedInterfaces);

        return array_combine($interfaceNames, $extendedInterfaces);
    }
}
