<?php

declare(strict_types=1);

namespace DoctrineCodingStandard\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;

class ExceptionInterfaceNamingSniffTest extends TestCase
{
    public function testValidInterface() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/../../../test/ExceptionInterfaceNamingSniffValid.php');
        self::assertNoSniffErrorInFile($phpcsFile);
    }

    public function testInvalidInterface() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/../../../test/ExceptionInterfaceNamingSniffNotValid.php');

        self::assertSame(4, $phpcsFile->getErrorCount());

        self::assertSniffError($phpcsFile, 10, 'NotAnException');
        self::assertSniffError($phpcsFile, 14, 'NotAnException');
        self::assertSniffError($phpcsFile, 18, 'NotAnException');
        self::assertSniffError($phpcsFile, 22, 'NotAnException');
    }
}
