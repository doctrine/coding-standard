<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;

final class ExceptionInterfaceNamingSniffTest extends TestCase
{
    public function testNoErrors() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/data/exceptionInterfaceNaming.noErrors.php');
        self::assertNoSniffErrorInFile($phpcsFile);
    }

    public function testNoErrorsNoNamespace() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/data/exceptionInterfaceNaming.noErrors.noNamespace.php');
        self::assertNoSniffErrorInFile($phpcsFile);
    }

    public function testErrors() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/data/exceptionInterfaceNaming.errors.php');

        self::assertSniffError($phpcsFile, 10, 'NotAnException');
        self::assertSniffError($phpcsFile, 14, 'NotAnException');
        self::assertSniffError($phpcsFile, 18, 'NotAnException');
        self::assertSniffError($phpcsFile, 22, 'NotAnException');
        self::assertSniffError($phpcsFile, 26, 'NotAnException');

        self::assertSame(5, $phpcsFile->getErrorCount());
    }

    public function testErrorsInvalidThrowable() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/data/exceptionInterfaceNaming.errors.sameNamespace.php');

        self::assertSame(1, $phpcsFile->getErrorCount());

        self::assertSniffError($phpcsFile, 7, 'NotAnException');
    }
}
