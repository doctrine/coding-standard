<?php

declare(strict_types=1);

namespace DoctrineCodingStandard\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;

class ExceptionInterfaceNamingSniffTest extends TestCase
{
    private const PATH_TO_CLASSES = __DIR__ . '/../../../test/exception-interface/';

    public function testValidInterface() : void
    {
        $phpcsFile = self::checkFile(__DIR__ . '/../../../test/ExceptionInterfaceNamingSniffValid.php');
        self::assertNoSniffErrorInFile($phpcsFile);
    }

    /**
     * @dataProvider provideInvalidInterfaceFiles
     */
    public function testInvalidInterface(string $filePath, int $line) : void
    {
        $phpcsFile = self::checkFile($filePath);

        self::assertSame(1, $phpcsFile->getErrorCount());
        self::assertSniffError($phpcsFile, $line, 'NotAnException');
    }

    /**
     * @return string[][]|int[][]
     */
    public function provideInvalidInterfaceFiles() : array
    {
        return [
            'Missing exception suffix' => [self::PATH_TO_CLASSES . 'NoSuffix.php', 9],
            'Extends no exception' => [self::PATH_TO_CLASSES . 'NoExtendedException.php', 9],
            'Extends nothing' => [self::PATH_TO_CLASSES . 'ExtendedsNothingException.php', 7],
            'Wrong throwable' => [self::PATH_TO_CLASSES . 'DifferentThrowableException.php', 9],
            'Throwable in same namespace' => [self::PATH_TO_CLASSES . 'ThrowableSameNamespaceException.php', 7],
        ];
    }
}
