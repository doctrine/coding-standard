<?php

/** Created by PhpStorm. */

declare(strict_types=1);

namespace Test;

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
    public function getBar() : int
    {
        return 123;
    }

    /**
     * Very important getter.
     */
    public function getBaz() : int
    {
        return 456;
    }
}
