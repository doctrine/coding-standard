<?php

namespace Doctrine\Tests\Sniffs\Classes;

use Doctrine\Sniffs\Classes\ExceptionInterfaceNamingSniff;
use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Files\LocalFile;
use PHP_CodeSniffer\Ruleset;
use PHPUnit\Framework\TestCase;

class ExceptionInterfaceNamingSniffTest extends TestCase
{
    private const PATH_TO_CLASSES = __DIR__.'/../../../../test/';

    public function testRegister()
    {
        $sniff = new ExceptionInterfaceNamingSniff();

        self::assertSame([T_INTERFACE], $sniff->register());
    }

    /**
     * @dataProvider provideValidInterfaceFiles
     *
     * @param string $filePath
     */
    public function testValidInterface(string $filePath)
    {
        $phpcsFile = $this->createFile($filePath);

        $stackPtr = $phpcsFile->findNext([T_INTERFACE], 1);

        (new ExceptionInterfaceNamingSniff())->process($phpcsFile, $stackPtr);

        self::assertSame(0, $phpcsFile->getErrorCount());
    }

    /**
     * @dataProvider provideInvalidInterfaceFiles
     *
     * @param string $filePath
     */
    public function testInvalidInterface(string $filePath)
    {
        $phpcsFile = $this->createFile($filePath);

        $stackPtr = $phpcsFile->findNext([T_INTERFACE], 1);

        (new ExceptionInterfaceNamingSniff())->process($phpcsFile, $stackPtr);

        self::assertSame(1, $phpcsFile->getErrorCount());
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
            'Missing exception suffix' => [self::PATH_TO_CLASSES.'NoSuffix.php'],
            'Extends no exception' => [self::PATH_TO_CLASSES.'NoExtendedException.php'],
            'Extends nothing' => [self::PATH_TO_CLASSES.'ExtendedsNothingException.php'],
            'Wrong throwable' => [self::PATH_TO_CLASSES.'DifferentThrowableException.php'],
        ];
    }

    private function createFile(string $pathToTestFile) : File
    {
        $config  = new Config();
        $config->standards = ['Generic'];

        $phpcsFile = new class($pathToTestFile, new Ruleset($config), $config) extends LocalFile {
            public function process()
            {
                parent::process();

                $this->errorCount   = 0;
                $this->warningCount = 0;
                $this->fixableCount = 0;
                $this->fixedCount   = 0;
            }
        };
        $phpcsFile->process();

        return $phpcsFile;
    }
}
