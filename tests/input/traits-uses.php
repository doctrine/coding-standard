<?php

declare(strict_types=1);

namespace TraitUses;

class Foo
{
    use T1;

}

class Bar
{
    use T2, T3;

    use T4 {
        x as public;
    }

    use T5;
    public function __construct()
    {
    }
}
