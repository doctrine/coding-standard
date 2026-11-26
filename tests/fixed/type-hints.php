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

    /**
     * @return array{
     *     name: string,
     * }
     */
    public function getArrayShape(): array
    {
        return ['name' => 'Doctrine'];
    }
}

class UnionTypeHints
{
    private int|string|null $x = 1;

    /** @param array<int|string|null> $value */
    public function set(array $value): void
    {
    }
}
