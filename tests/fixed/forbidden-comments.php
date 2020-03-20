<?php

declare(strict_types=1);

namespace Test;

class Foo
{
    public function __construct()
    {
        echo 'Hello';
    }

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

interface Bar
{
}

trait Baz
{
}
