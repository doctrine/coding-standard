<?php

declare(strict_types=1);

namespace Test;

use BarException;
use FooException;

class Test
{
    /**
     * Description
     */
    public function a() : void
    {
    }

    /**
     * Description
     * More Description
     * Even More Description
     */
    public function b() : void
    {
    }

    /**
     * First Paragraph Description
     *
     * Second Paragraph Description
     *
     * @param array<int> $foo
     *
     * @throws FooException
     */
    public function c(iterable $foo) : void
    {
    }

    /**
     * Description
     * More Description
     *
     * @internal
     * @deprecated
     *
     * @link https://example.com
     * @see  other
     * @uses other
     *
     * @ORM\Id
     * @ORM\Column
     * @ODM\Id
     * @ODM\Column
     * @PHPCR\Uuid
     * @PHPCR\Field
     *
     * @param array<int> $foo
     * @param array<int> $bar
     *
     * @return array<int>
     *
     * @throws FooException
     * @throws BarException
     */
    public function d(iterable $foo, iterable $bar) : iterable
    {
    }
}
