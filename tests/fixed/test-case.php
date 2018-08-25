<?php

declare(strict_types=1);

namespace Fancy;

use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * @requires PHP 7.2
 */
final class TestCase extends BaseTestCase
{
    /**
     * @beforeClass
     * @afterClass
     */
    public static function doStuff() : void
    {
    }

    /**
     * @before
     */
    public function createDependencies() : void
    {
    }

    /**
     * @test
     *
     * @covers MyClass::test
     *
     * @uses MyClass::__construct
     */
    public function methodShouldDoStuff() : void
    {
    }
}
