<?php

declare(strict_types=1);

namespace Doctrine\Tests\CodingStandard;

/**
 * @runTestsInSeparateProcesses
 */
final class ArrayIndentationTest extends TestCase
{
    /**
     * @return (string|int)[]
     */
    protected function getExpectedErrors() : array
    {
        return [
            ['Generic.Arrays.ArrayIndent.KeyIncorrect', 6],
            ['Generic.Arrays.ArrayIndent.KeyIncorrect', 7],
            ['Generic.Arrays.ArrayIndent.KeyIncorrect', 8],
            ['Generic.Arrays.ArrayIndent.KeyIncorrect', 9],
            ['Generic.Arrays.ArrayIndent.KeyIncorrect', 11],
            ['Generic.Arrays.ArrayIndent.KeyIncorrect', 15],
            ['Generic.Arrays.ArrayIndent.KeyIncorrect', 16],
            ['Generic.Arrays.ArrayIndent.KeyIncorrect', 17],
            ['Generic.Arrays.ArrayIndent.KeyIncorrect', 20],
            ['Generic.Arrays.ArrayIndent.KeyIncorrect', 22],
        ];
    }
}
