<?php

declare(strict_types=1);

namespace Fancy;

use PHPUnit\Framework\TestCase;

/**
 * @package Quite useless
 *
 * @requires PHP 7.2
 */
final class TestCase extends TestCase
{
    /**
     * @beforeClass
     * @afterClass
     */
    static public function doStuff(): void
    {
    }

    /**
     * @before
     */
    public function createDependencies()
    {
    }

    /**
     * @test
     *
     * @covers MyClass::test
     *
     * @uses MyClass::__construct
     */
    public function methodShouldDoStuff()
    {
    }
}
