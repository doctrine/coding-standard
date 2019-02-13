<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Arrays;

use SlevomatCodingStandard\Sniffs\TestCase;

final class OperatorSpacingAfterSniffTest extends TestCase
{
    public function testNoErrors() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/data/operatorSpacingAfterSniff.noErrors.php');
        self::assertNoSniffErrorInFile($phpcsFile);
    }

    public function testErrors() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/data/operatorSpacingAfterSniff.errors.php');

        self::assertSame(1, $phpcsFile->getErrorCount());

        self::assertSniffError($phpcsFile, 4, 'NoSpaceAfterAssigment');
    }
}
