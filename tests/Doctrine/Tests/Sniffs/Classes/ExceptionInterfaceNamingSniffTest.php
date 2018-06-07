<?php

namespace Doctrine\Tests\Sniffs\Classes;

use Doctrine\Sniffs\Classes\ExceptionInterfaceNamingSniff;
use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Files\DummyFile;
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
        ];
    }

    public function provideInvalidInterfaceFiles() : array
    {
        return [
            'Missing exception suffix' => [self::PATH_TO_CLASSES.'NoSuffix.php'],
            'Extends no exception' => [self::PATH_TO_CLASSES.'NoExtendedException.php'],
            'Extends nothing' => [self::PATH_TO_CLASSES.'ExtendedsNothingException.php'],
        ];
    }

    private function createFile(string $pathToTestFile) : DummyFile
    {
        $config  = new Config();
        $config->standards = ['Generic'];
        $ruleset = new Ruleset($config);

        $phpcsFile = new DummyFile(file_get_contents($pathToTestFile), $ruleset, $config);
        $phpcsFile->process();
        $phpcsFile->setErrorCounts(0,0,0,0);

        return $phpcsFile;
    }
}
