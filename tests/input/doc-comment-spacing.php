<?php

declare(strict_types=1);

namespace Test;

use BarException;
use FooException;

class Test
{
    /**
     *
     * Description
     *
     */
    public function a(): void
    {
    }

    /**
     * Description
     * More Description
     * Even More Description
     */
    public function b(): void
    {
    }

    /**
     * First Paragraph Description
     *
     * Second Paragraph Description
     * @throws FooException
     * @param int[] $foo
     */
    public function c(iterable $foo): void
    {
    }

    /**
     *
     * Description
     * More Description
     * @throws FooException
     * @param         int[] $foo
     * @uses other
     * @throws BarException
     * @return         int[]
     * @ORM\Id
     * @internal
     * @link https://example.com
     * @ODM\Id
     * @deprecated
     * @PHPCR\Uuid
     * @param         int[] $bar
     * @PHPCR\Field
     * @ODM\Column
     * @ORM\Column
     * @psalm-param   array<string, int> $foo
     * @phpstan-return array<string, int>
     * @phpstan-param array<string, int> $foo
     * @psalm-return   array<string, int>
     * @see  other
     *
     */
    public function d(iterable $foo, iterable $bar): iterable
    {
    }

    /**
     * @param iterable<mixed> $singleAnnotation
     */
    public function e(iterable $singleAnnotation): void
    {
    }
}
