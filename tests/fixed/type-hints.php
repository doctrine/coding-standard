<?php

declare(strict_types=1);

namespace TypeHints;

use Iterator;
use Traversable;

class TraversableTypeHints
{
    /** @var Traversable */
    private $parameter;

    /**
     * @param Iterator $iterator
     *
     * @return Traversable
     */
    public function get(Iterator $iterator) : Traversable
    {
        return $this->parameter;
    }
}
