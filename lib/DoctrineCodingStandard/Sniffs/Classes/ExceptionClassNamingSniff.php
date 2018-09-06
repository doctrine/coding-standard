<?php

declare(strict_types=1);

namespace DoctrineCodingStandard\Sniffs\Classes;

use DoctrineCodingStandard\Helpers\UseStatementHelper;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use const T_ABSTRACT;
use const T_CLASS;
use const T_FINAL;
use function count;
use function preg_grep;
use function preg_match;

final class ExceptionClassNamingSniff implements Sniff
{
    private const CODE_NOT_AN_EXCEPTION_CLASS = 'NotAnExceptionClass';

    /**
     * @return int[]
     */
    public function register() : array
    {
        return [T_CLASS];
    }

    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     * @param int $pointer
     */
    public function process(File $phpcsFile, $pointer) : void
    {
        $isAbstract              = $phpcsFile->findFirstOnLine([T_ABSTRACT], $pointer) !== false;
        $isFinal                 = $phpcsFile->findFirstOnLine([T_FINAL], $pointer) !== false;
        $isExtendingException    = $this->isExtendingException($phpcsFile, $pointer);
        $isImplementingException = $this->isImplementingException($phpcsFile, $pointer);
        $hasExceptionName        = $this->hasExceptionSuffix((string) $phpcsFile->getDeclarationName($pointer));
        $hasValidClassName       = ($isAbstract && $hasExceptionName) ||
            (! $isAbstract && ! $hasExceptionName && $isFinal);
        $isValidException        = $hasValidClassName && ($isExtendingException || $isImplementingException);
        $isNoException           = ! $hasExceptionName && ! $isExtendingException && ! $isImplementingException;

        if ($isValidException || $isNoException) {
            return;
        }

        if (! $hasValidClassName) {
            $phpcsFile->addError(
                'Exception classes must end with an "Exception" suffix',
                $pointer,
                self::CODE_NOT_AN_EXCEPTION_CLASS
            );

            return;
        }

        $phpcsFile->addError(
            'Exception classes must be either abstract or final.',
            $pointer,
            self::CODE_NOT_AN_EXCEPTION_CLASS
        );
    }

    private function isExtendingException(File $phpcsFile, int $stackPtr) : bool
    {
        $extendsClass = $phpcsFile->findExtendedClassName($stackPtr);
        if ($extendsClass === false) {
            return false;
        }

        return $this->hasExceptionSuffix($extendsClass);
    }

    private function isImplementingException(File $phpcsFile, int $stackPtr) : bool
    {
        $implementedInterfaces = $phpcsFile->findImplementedInterfaceNames($stackPtr);
        if ($implementedInterfaces === false) {
            return false;
        }

        $isImplementingExceptions = count(preg_grep('/Exception$/', $implementedInterfaces)) > 0;

        $importedClassNames = UseStatementHelper::getUseStatements($phpcsFile);

        // TODO Should throwable be checked separately, because it can't be implemented on non-abstract exception class?
        $isImplementingThrowable = UseStatementHelper::isImplementingThrowable(
            $importedClassNames,
            $implementedInterfaces
        );

        return $isImplementingExceptions || $isImplementingThrowable;
    }

    private function hasExceptionSuffix(string $className) : bool
    {
        return preg_match('/Exception$/', $className) === 1;
    }
}
