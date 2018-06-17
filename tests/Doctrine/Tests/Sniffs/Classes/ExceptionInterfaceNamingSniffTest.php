<?php

namespace Doctrine\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;

class ExceptionInterfaceNamingSniffTest extends TestCase
{
    private const PATH_TO_CLASSES = __DIR__.'/../../../../test/';

    /**
     * @dataProvider provideValidInterfaceFiles
     *
     * @param string $filePath
     */
    public function testValidInterface(string $filePath)
    {
        $phpcsFile = self::checkFile($filePath);
        self::assertNoSniffErrorInFile($phpcsFile);
    }

    /**
     * @dataProvider provideInvalidInterfaceFiles
     *
     * @param string $filePath
     */
    public function testInvalidInterface(string $filePath, int $line)
    {
        $phpcsFile = self::checkFile($filePath);

        self::assertSame(1, $phpcsFile->getErrorCount());
        self::assertSniffError($phpcsFile, $line, 'NotAnException');
    }

    public function provideValidInterfaceFiles() : array
    {
        return [
            'Imports and uses Throwable' => [self::PATH_TO_CLASSES.'ValidAException.php'],
            'Uses Throwable' => [self::PATH_TO_CLASSES.'ValidBException.php'],
            'Imports and uses exception interface' => [self::PATH_TO_CLASSES.'ValidCException.php'],
            'Uses exception interface' => [self::PATH_TO_CLASSES.'ValidDException.php'],
            'Combination of interfaces' => [self::PATH_TO_CLASSES.'ValidEException.php'],
            'Not relevant for the sniff' => [self::PATH_TO_CLASSES.'NoSuffixAndInterface.php'],
            'Throwable namespace alias' => [self::PATH_TO_CLASSES.'ValidFException.php'],
            'Exception namespace alias' => [self::PATH_TO_CLASSES.'ValidGException.php'],
            'Comma separated namespaces' => [self::PATH_TO_CLASSES.'ValidHException.php'],
            'Group use namespaces' => [self::PATH_TO_CLASSES.'ValidIException.php'],
        ];
    }

    public function provideInvalidInterfaceFiles() : array
    {
        return [
            'Missing exception suffix' => [self::PATH_TO_CLASSES.'NoSuffix.php', 9],
            'Extends no exception' => [self::PATH_TO_CLASSES.'NoExtendedException.php', 9],
            'Extends nothing' => [self::PATH_TO_CLASSES.'ExtendedsNothingException.php', 7],
            'Wrong throwable' => [self::PATH_TO_CLASSES.'DifferentThrowableException.php', 9],
        ];
    }
}
