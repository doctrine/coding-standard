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
     * @throws FooException
     * @param array<int> $foo
     */
    public function c(iterable $foo) : void
    {
    }

    /**
     *
     * Description
     * More Description
     * @throws FooException
     * @param array<int> $foo
     * @uses other
     * @throws BarException
     * @return array<int>
     * @ORM\Id
     * @internal
     * @link https://example.com
     * @ODM\Id
     * @deprecated
     * @PHPCR\Uuid
     * @param array<int> $bar
     * @PHPCR\Field
     * @ODM\Column
     * @ORM\Column
     * @see  other
     *
     */
    public function d(iterable $foo, iterable $bar) : iterable
    {
    }
}
