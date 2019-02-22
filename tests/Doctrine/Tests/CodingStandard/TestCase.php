<?php

declare(strict_types=1);

namespace Doctrine\Tests\CodingStandard;

use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Files\LocalFile;
use PHP_CodeSniffer\Runner;
use PHPUnit\Framework\TestCase as BaseTestCase;
use RuntimeException;
use function array_key_exists;
use function count;
use function implode;
use function sprintf;
use function strpos;
use function strrpos;
use function substr;

abstract class TestCase extends BaseTestCase
{
    final public function testValidator() : void
    {
        $codeSniffer = $this->createCodeSniffer();
        $file        = $this->createFile($codeSniffer);

        $this->processFile($file);

        $expectedErrors = $this->getExpectedErrors();

        self::assertSame(
            count($expectedErrors),
            $file->getErrorCount(),
            sprintf(
                'Expected %d error%s but found %d.',
                count($expectedErrors),
                count($expectedErrors) === 1 ? '' : 's',
                $file->getErrorCount()
            )
        );

        foreach ($expectedErrors as $expectedError) {
            [$expectedErrorName, $expectedErrorLine] = $expectedError;

            self::assertTrue(
                self::hasError($file, ...$expectedError),
                sprintf(
                    'Expected error %s at line %d but it was not found.',
                    $expectedErrorName,
                    $expectedErrorLine
                )
            );
        }
    }

    /**
     * @return (string|int)[]
     */
    abstract protected function getExpectedErrors() : array;

    final public function testFixer() : void
    {
        $codeSniffer = $this->createCodeSniffer();
        $file        = $this->createFile($codeSniffer);

        $this->fixFile($file);

        self::assertStringEqualsFile($this->getSubjectFixedFilename(), $file->fixer->getContents());
    }

    protected function getSubjectName() : string
    {
        // Doctrine\Tests\CodingStandard\SomeSubjectTest
        return substr(static::class, strrpos(static::class, '\\') + 1, -4);
    }

    final protected function getSubjectFilename() : string
    {
        return sprintf('%s/data/%s.php', __DIR__, $this->getSubjectName());
    }

    final protected function getSubjectFixedFilename() : string
    {
        return sprintf('%s/data/%s.fixed.php', __DIR__, $this->getSubjectName());
    }

    final protected function createCodeSniffer() : Runner
    {
        $codeSniffer = new Runner();

        $configuration = ['-s'];

        $this->setRunTestInSeparateProcess(true);
        $excludedSniffs = $this->getImplicitlyIgnoredSniffs();
        if (count($excludedSniffs) !== 0) {
            $configuration[] = sprintf('--exclude=%s', implode(',', $excludedSniffs));
        }

        $codeSniffer->config = new Config($configuration);

        $codeSniffer->init();
        $codeSniffer->ruleset->populateTokenListeners();

        return $codeSniffer;
    }

    private function createFile(Runner $codeSniffer) : File
    {
        return new LocalFile($this->getSubjectFilename(), $codeSniffer->ruleset, $codeSniffer->config);
    }

    private function processFile(File $file) : void
    {
        $file->process();
        $this->propagateInternalErrors($file);
    }

    private function fixFile(File $file) : void
    {
        $this->processFile($file);

        $file->disableCaching();
        $file->fixer->fixFile();
    }

    protected function propagateInternalErrors(File $file) : void
    {
        foreach ($file->getErrors() as $errorsOnLine) {
            foreach ($errorsOnLine as $errorsOnPosition) {
                foreach ($errorsOnPosition as $error) {
                    if (strpos($error['source'], 'Internal.') === 0) {
                        throw new RuntimeException($error['message']);
                    }
                }
            }
        }
    }

    /**
     * @return string[]
     */
    protected function getImplicitlyIgnoredSniffs() : array
    {
        return ['Squiz.Classes.ClassFileName'];
    }

    private function hasError(File $file, string $error, int $line) : bool
    {
        if (! array_key_exists($line, $file->getErrors())) {
            return false;
        }

        foreach ($file->getErrors()[$line] as $errorsOnPosition) {
            foreach ($errorsOnPosition as $errorOnPosition) {
                if ($errorOnPosition['source'] !== $error) {
                    continue;
                }

                return true;
            }
        }

        return false;
    }
}
