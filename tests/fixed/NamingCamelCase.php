<?php

declare(strict_types=1);

namespace Example;

class NamingCamelCase
{
    /** @var mixed */
    public $A;

    /** @var mixed */
    protected $B;

    /** @var mixed */
    private $C;

    public function fcn(string $A) : void
    {
        $Test = $A;
    }
}
