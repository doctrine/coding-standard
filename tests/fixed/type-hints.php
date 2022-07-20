<?php

declare(strict_types=1);

namespace TypeHints;

use Iterator;
use Traversable;

class TraversableTypeHints
{
    /** @var Traversable */
    private Traversable $parameter;

    /**
     * @param Iterator $iterator
     *
     * @return Traversable
     */
    public function get(Iterator $iterator): Traversable
    {
        return $this->parameter;
    }
}

class UnionTypeHints
{
    private int|string|null $x = 1;
}
