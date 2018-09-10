<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;

final class ExceptionClassNamingSniffTest extends TestCase
{
    public function testNoErrors() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/data/exceptionClassNaming.noErrors.php');
        self::assertNoSniffErrorInFile($phpcsFile);
    }
    public function testNoErrorsNoNamespace() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/data/exceptionClassNaming.noErrors.noNamespace.php');
        self::assertNoSniffErrorInFile($phpcsFile);
    }

    public function testErrors() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/data/exceptionClassNaming.errors.php');

        self::assertSame(4, $phpcsFile->getErrorCount());

        self::assertSniffError($phpcsFile, 9, ExceptionClassNamingSniff::CODE_MISSING_SUFFIX);
        self::assertSniffError($phpcsFile, 13, ExceptionClassNamingSniff::CODE_NOT_EXTENDING_EXCEPTION);
        self::assertSniffError($phpcsFile, 17, ExceptionClassNamingSniff::CODE_NOT_EXTENDING_EXCEPTION);
        self::assertSniffError($phpcsFile, 21, ExceptionClassNamingSniff::CODE_SUPERFLUOUS_SUFFIX);
    }

    public function testErrorsInvalidThrowable() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/data/exceptionClassNaming.errors.sameNamespace.php');

        self::assertSame(1, $phpcsFile->getErrorCount());

        self::assertSniffError($phpcsFile, 7, ExceptionClassNamingSniff::CODE_NOT_EXTENDING_EXCEPTION);
    }
}
