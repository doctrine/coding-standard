<?php

declare(strict_types=1);

namespace DoctrineCodingStandard\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;

class ExceptionClassNamingSniffTest extends TestCase
{
    public function testValidClass() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/../../../test/ExceptionClassNamingSniffValid.php');
        self::assertNoSniffErrorInFile($phpcsFile);
    }

    public function testInvalidClass() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/../../../test/ExceptionClassNamingSniffNotValid.php');

        self::assertSniffError($phpcsFile, 9, 'NotAnExceptionClass');
        self::assertSniffError($phpcsFile, 13, 'NotAnExceptionClass');
        self::assertSniffError($phpcsFile, 17, 'NotAnExceptionClass');
        self::assertSniffError($phpcsFile, 21, 'NotAnExceptionClass');
        self::assertSniffError($phpcsFile, 25, 'NotAnExceptionClass');
        self::assertSniffError($phpcsFile, 29, 'NotAnExceptionClass');
        self::assertSniffError($phpcsFile, 33, 'NotAnExceptionClass');

        self::assertSame(7, $phpcsFile->getErrorCount());
    }

    public function testInvalidThrowable() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/../../../test/ExceptionClassNamingSniffSameNamespace.php');

        self::assertSame(1, $phpcsFile->getErrorCount());

        self::assertSniffError($phpcsFile, 7, 'NotAnExceptionClass');
    }
}
