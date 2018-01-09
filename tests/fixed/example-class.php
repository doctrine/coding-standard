<?php

declare(strict_types=1);

namespace Example;

use Doctrine\Sniffs\Spacing\ControlStructureSniff;
use function assert;
use function strlen;
use function substr;

/**
 * Description
 */
class Example implements \IteratorAggregate
{
    /** @var int|null */
    private $foo;

    /** @var string[] */
    private $bar;

    /** @var bool */
    private $baz;

    /** @var ControlStructureSniff|int|string|null */
    private $baxBax;

    public function __construct(?int $foo = null, array $bar = [], bool $baz = false, $baxBax = 'unused')
    {
        $this->foo    = $foo;
        $this->bar    = $bar;
        $this->baz    = $baz;
        $this->baxBax = $baxBax;
    }

    /**
     * Description
     */
    public function getFoo() : ?int
    {
        return $this->foo;
    }

    /**
     * @return iterable
     */
    public function getIterator() : array
    {
        assert($this->bar !== null);
        return new \ArrayIterator($this->bar);
    }

    public function isBaz() : bool
    {
        return $this->baz;
    }

    public function mangleBar(int $length) : void
    {
        if (! $this->baz) {
            throw new \InvalidArgumentException();
        }

        $this->bar = (string) $this->baxBax ?? substr($this->bar, strlen($this->bar - $length));
    }
}
