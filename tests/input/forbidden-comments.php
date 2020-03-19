<?php

/**
 * Created by IntelliJ IDEA.
 * User: g9735
 * Date: 16/12/18
 * Time: 20:49
 */

declare(strict_types=1);

namespace Test;

/**
 * Class Foo
 */
class Foo
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        echo 'Hello';
    }

    /**
     * Bar getter.
     */
    public function getBar(): int
    {
        return 123;
    }

    /**
     * Very important getter.
     */
    public function getBaz(): int
    {
        return 456;
    }
}

/**
 * Interface Bar
 */
interface Bar
{
}

/**
 * Trait Baz
 */
trait Baz
{
}
