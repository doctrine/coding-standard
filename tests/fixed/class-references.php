<?php

declare(strict_types=1);

class Foo
{
}

class Bar extends Foo
{
    /**
     * @return string[]
     */
    public function names(): iterable
    {
        yield self::class;
        yield self::class;
        yield static::class;
        yield get_class(new stdClass());
        yield parent::class;
        yield static::class;
    }
}
