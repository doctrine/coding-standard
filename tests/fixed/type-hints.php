<?php

declare(strict_types=1);

namespace TypeHints;

use Iterator;
use Traversable;

class TraversableTypeHints
{
    /** @var Traversable|string[] */
    private $parameter;

    /**
     * @param Iterator|string[] $iterator
     *
     * @return Traversable|string[]
     */
    public function get(Iterator $iterator) : Traversable
    {
        return $this->parameter;
    }
}
