<?php

declare(strict_types=1);

namespace Example;

class NamingCamelCase
{
    public mixed $A;

    protected mixed $B;

    private mixed $C;

    public function fcn(string $A): void
    {
        $Test = $A;
    }
}
