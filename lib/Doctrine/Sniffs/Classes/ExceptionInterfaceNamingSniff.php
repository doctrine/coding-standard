<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Classes;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use SlevomatCodingStandard\Helpers\UseStatementHelper;
use Throwable;
use const T_EXTENDS;
use const T_INTERFACE;
use const T_OPEN_CURLY_BRACKET;
use function array_map;
use function count;
use function explode;
use function in_array;
use function preg_grep;
use function strpos;

class ExceptionInterfaceNamingSniff implements Sniff
{
    private const CODE_NOT_AN_EXCEPTION = 'NotAnException';

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        return [T_INTERFACE];
    }

    /**
     * {@inheritdoc}
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $importedClassNames = $this->parseImportedClassNames($phpcsFile);
        $extendedInterfaces = $this->parseExtendedInterfaces($phpcsFile, $stackPtr);

        $hasExceptionName = strpos($phpcsFile->getDeclarationName($stackPtr), 'Exception') !== false;

        $isExtendingThrowable = (isset($importedClassNames[Throwable::class]) &&
            in_array(Throwable::class, $extendedInterfaces, true)) ||
            in_array('\\Throwable', $extendedInterfaces, true);

        // Expects that an interface with the suffix "Exception" is a valid exception interface
        $isExtendingException = count(preg_grep('/Exception$/', $extendedInterfaces)) > 0;

        if ($hasExceptionName && ! $isExtendingException && ! $isExtendingThrowable) {
            $phpcsFile->addError(
                'Interface does not extend an exception interface',
                $stackPtr,
                self::CODE_NOT_AN_EXCEPTION
            );

            return;
        }

        if (! $hasExceptionName && ($isExtendingException || $isExtendingThrowable)) {
            $phpcsFile->addError(
                'Exception interface needs an "Exception" name suffix',
                $stackPtr,
                self::CODE_NOT_AN_EXCEPTION
            );

            return;
        }
    }

    /**
     * @todo Cover class alias, comma separation and group use declaration (UseStatementHelper)
     *
     * @return string[]
     */
    private function parseImportedClassNames(File $phpcsFile) : array
    {
        $importedClasses = [];
        foreach (UseStatementHelper::getUseStatements($phpcsFile, 0) as $useStatement) {
            $importedClasses[$useStatement->getNameAsReferencedInFile()] = $useStatement->getFullyQualifiedTypeName();
        }

        return $importedClasses;
    }

    /**
     * @return string[]
     */
    private function parseExtendedInterfaces(File $phpcsFile, int $stackPtr) : array
    {
        $limit = $phpcsFile->findNext([T_OPEN_CURLY_BRACKET], $stackPtr) - 1;
        $start = $phpcsFile->findNext([T_EXTENDS], $stackPtr, $limit);

        if ($start === false) {
            return [];
        }

        $extendedInterfaces = explode(',', $phpcsFile->getTokensAsString($start + 1, $limit - $start));
        $extendedInterfaces = array_map('\trim', $extendedInterfaces);

        return $extendedInterfaces;
    }
}
