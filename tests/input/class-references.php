<?php

declare(strict_types=1);

class Foo
{
}

class Bar extends Foo
{
    /**
     * @return iterable<string>
     */
    public function names() : iterable
    {
        yield __CLASS__;
        yield get_class();
        yield get_class($this);
        yield get_class(new stdClass());
        yield get_parent_class();
        yield get_called_class();
    }
}
