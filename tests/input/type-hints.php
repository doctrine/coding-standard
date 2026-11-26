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
    public function get(Iterator $iterator): Traversable
    {
        return $this->parameter;
    }

    /**
     * @return array{
     *     name: string
     * }
     */
    public function getArrayShape(): array
    {
        return ['name' => 'Doctrine'];
    }
}

class UnionTypeHints
{
    /** @var null|int|string */
    private $x = 1;

    /** @param array<null|int|string> $value */
    public function set(array $value): void
    {
    }
}
