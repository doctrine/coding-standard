<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Classes;

use Doctrine\Helpers\ClassHelper;
use Doctrine\Helpers\InheritanceHelper;
use Doctrine\Helpers\UseStatementHelper;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use const T_INTERFACE;

final class ExceptionInterfaceNamingSniff implements Sniff
{
    private const CODE_NOT_AN_EXCEPTION = 'NotAnException';

    /**
     * @return int[]|string[]
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
        $extendedInterfaces = InheritanceHelper::parseExtendedInterfaces($phpcsFile, $pointer);

        // Set original classname instead of alias
        $extendedInterfaces = array_map(function (string $extendedInterface) use ($importedClassNames) : string {
            return $importedClassNames[$extendedInterface] ?? $extendedInterface;
        }, $extendedInterfaces);

        $declarationName         = $phpcsFile->getDeclarationName($pointer);
        $endsWithExceptionSuffix = ClassHelper::hasExceptionSuffix((string) $declarationName);

        $isExtendingThrowable = UseStatementHelper::isImplementingThrowable($importedClassNames, $extendedInterfaces);

        // Expects that an interface with the suffix "Exception" is a valid exception interface
        $isExtendingException = InheritanceHelper::hasExceptionInterface($extendedInterfaces);

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
}
