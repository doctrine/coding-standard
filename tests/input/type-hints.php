<?php

declare(strict_types=1);

namespace TypeHints;

class Foo
{
    /**
     * @return string[]
     */
    public function names() : iterable
    {
        yield 'name1';
    }
}
