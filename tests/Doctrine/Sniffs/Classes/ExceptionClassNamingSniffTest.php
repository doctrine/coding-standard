<?php

namespace Doctrine\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;

class ExceptionClassNamingSniffTest extends TestCase
{
    private const PATH_TO_CLASSES = __DIR__.'/../../../test/exception-class/';

    /**
     * @dataProvider provideValidInterfaceFiles
     *
     * @param string $filePath
     */
    public function testValidClass(string $filePath)
    {
        $phpcsFile = self::checkFile($filePath);
        self::assertNoSniffErrorInFile($phpcsFile);
    }

    /**
     * @dataProvider provideInvalidInterfaceFiles
     *
     * @param string $filePath
     */
    public function testInvalidClass(string $filePath, int $line)
    {
        $phpcsFile = self::checkFile($filePath);

        self::assertSame(1, $phpcsFile->getErrorCount());
        self::assertSniffError($phpcsFile, $line, 'NotAnExceptionClass');
    }

    public function provideValidInterfaceFiles() : array
    {
        return [
            'Extends exception' => [self::PATH_TO_CLASSES.'ValidA.php'],
            'Implements exception' => [self::PATH_TO_CLASSES.'ValidB.php'],
            'Extends fqcn exception' => [self::PATH_TO_CLASSES.'ValidC.php'],
            'Implements fqcn exception' => [self::PATH_TO_CLASSES.'ValidD.php'],
            'Implements Throwable' => [self::PATH_TO_CLASSES.'ValidE.php'],
            'Abstract extends exception' => [self::PATH_TO_CLASSES.'ValidAException.php'],
            'Abstract implements exception' => [self::PATH_TO_CLASSES.'ValidBException.php'],
        ];
    }

    public function provideInvalidInterfaceFiles() : array
    {
        return [
            'Class with exception suffix' => [self::PATH_TO_CLASSES.'NotAbstractException.php', 7],
        ];
    }
}
