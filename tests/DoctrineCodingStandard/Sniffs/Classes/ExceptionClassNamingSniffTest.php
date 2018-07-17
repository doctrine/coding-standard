<?php

declare(strict_types=1);

namespace DoctrineCodingStandard\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;

class ExceptionClassNamingSniffTest extends TestCase
{
    private const PATH_TO_CLASSES = __DIR__ . '/../../../test/exception-class/';

    /**
     * @dataProvider provideValidInterfaceFiles
     */
    public function testValidClass(string $filePath) : void
    {
        $phpcsFile = self::checkFile($filePath);
        self::assertNoSniffErrorInFile($phpcsFile);
    }

    /**
     * @dataProvider provideInvalidInterfaceFiles
     */
    public function testInvalidClass(string $filePath, int $line) : void
    {
        $phpcsFile = self::checkFile($filePath);

        self::assertSame(1, $phpcsFile->getErrorCount());
        self::assertSniffError($phpcsFile, $line, 'NotAnExceptionClass');
    }

    /**
     * @return string[][]
     */
    public function provideValidInterfaceFiles() : array
    {
        return [
            'Extends exception' => [self::PATH_TO_CLASSES . 'ValidA.php'],
            'Implements exception' => [self::PATH_TO_CLASSES . 'ValidB.php'],
            'Extends fqcn exception' => [self::PATH_TO_CLASSES . 'ValidC.php'],
            'Implements fqcn exception' => [self::PATH_TO_CLASSES . 'ValidD.php'],
            'Implements Throwable' => [self::PATH_TO_CLASSES . 'ValidE.php'],
            'No exception' => [self::PATH_TO_CLASSES . 'ValidF.php'],
            'Abstract extends exception' => [self::PATH_TO_CLASSES . 'ValidAException.php'],
            'Abstract implements exception' => [self::PATH_TO_CLASSES . 'ValidBException.php'],
        ];
    }

    /**
     * @return string[][]|int[][]
     */
    public function provideInvalidInterfaceFiles() : array
    {
        return [
            'Class with exception suffix' => [self::PATH_TO_CLASSES . 'NotAbstractException.php', 7],
            'Inherits no other class or interface' => [self::PATH_TO_CLASSES . 'InheritsNothingException.php', 7],
            'Abstract without exception suffix' => [self::PATH_TO_CLASSES . 'AbstractWithoutSuffix.php', 7],
            'Throwable in same namespace' => [self::PATH_TO_CLASSES . 'ThrowableSameNamespaceException.php', 7],
            'Implements different throwable' => [self::PATH_TO_CLASSES . 'DifferentThrowableException.php', 9],
        ];
    }
}
