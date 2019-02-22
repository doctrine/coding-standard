<?php

declare(strict_types=1);

namespace Test;

class ConstantLsb
{
    public const A = 123;

    public function __construct()
    {
        echo self::A;
    }
}
