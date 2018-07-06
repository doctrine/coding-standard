<?php

declare(strict_types = 1);

namespace Example;

use function strlen as stringLength;
use Fancy\TestCase as TestCase;
use const PHP_RELEASE_VERSION as PHP_PATCH_VERSION;
use Doctrine\Sniffs\Spacing\ControlStructureSniff;

/**
 * Description
 * @author Invalid
 * @since 0.1
 */
class Example implements \IteratorAggregate
{
    private const VERSION = \PHP_VERSION - (PHP_MINOR_VERSION * 100) - PHP_PATCH_VERSION;

    /** @var int|null */
    private $foo;

    /** @var string[] */
    private $bar;

    /** @var bool */
    private $baz;

    /** @var ControlStructureSniff|int|string|null */
    private $baxBax;

    public function __construct(int $foo = null, array $bar = [], bool $baz = false, $baxBax = 'unused')
    {
        $this->foo    = $foo;
        $this->bar    = $bar;
        $this->baz    = $baz;
        $this->baxBax = $baxBax;
    }

    /**
     * Description
     * @return int|null
     */
    public function getFoo(): ? int
    {
        return $this->foo;
    }

    /**
     * @return iterable
     */
    public function getIterator():array
    {
        assert($this->bar !== null);
        return new \ArrayIterator($this->bar);
    }

    public function isBaz() : bool
    {
        list($foo, $bar, $baz) = $this->bar;

        return $this->baz;
    }

    public function mangleBar(int $length) : void
    {
        if (!$this->baz) {
            throw new \InvalidArgumentException();
        }

        $this->bar = (string) $this->baxBax ?? \substr($this->bar, stringLength($this->bar - $length));
    }

    public static function getMinorVersion() : int
    {
        return self::VERSION;
    }

    public static function getTestCase() : TestCase
    {
        return new TestCase();
    }
}
