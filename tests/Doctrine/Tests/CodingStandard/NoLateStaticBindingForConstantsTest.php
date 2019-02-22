<?php

declare(strict_types=1);

namespace Doctrine\Tests\CodingStandard;

/**
 * @runTestsInSeparateProcesses
 */
final class NoLateStaticBindingForConstantsTest extends TestCase
{
    /**
     * @return (string|int)[]
     */
    protected function getExpectedErrors() : array
    {
        return [
            [
                'SlevomatCodingStandard.Classes.DisallowLateStaticBindingForConstants.DisallowedLateStaticBindingForConstant',
                13,
            ],
        ];
    }
}
