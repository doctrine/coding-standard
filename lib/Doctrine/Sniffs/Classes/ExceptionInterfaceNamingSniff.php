<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Classes;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use Throwable;
use const T_EXTENDS;
use const T_INTERFACE;
use const T_OPEN_CURLY_BRACKET;
use const T_USE;
use function array_map;
use function count;
use function explode;
use function in_array;
use function preg_grep;
use function strpos;
use function strrchr;
use function trim;

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
        $importedClassNames = $this->parseImportedClassNames($phpcsFile, $stackPtr);
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
    private function parseImportedClassNames(File $phpcsFile, int $stackPtr) : array
    {
        $importedClasses = [];
        $occurence       = 0;

        while (($start = $phpcsFile->findNext([T_USE], $occurence, $stackPtr)) !== false) {
            $end = $phpcsFile->findEndOfStatement($start);

            $fqcn = $phpcsFile->getTokensAsString($start+2, $end-$start-2);

            $className = strrchr($fqcn, '\\');
            if ($className === false) {
                $className = $fqcn;
            }

            $importedClasses[trim($className, '\\')] = $fqcn;

            $occurence = $end;
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
        $extendedInterfaces = array_map('trim', $extendedInterfaces);

        return $extendedInterfaces;
    }
}
