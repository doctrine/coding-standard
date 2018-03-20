<?php

declare(strict_types=1);

namespace Example;

use Doctrine\Sniffs\Spacing\ControlStructureSniff;
use Fancy\TestCase;
use const PHP_MINOR_VERSION;
use const PHP_RELEASE_VERSION as PHP_PATCH_VERSION;
use const PHP_VERSION;
use function assert;
use function strlen as stringLength;
use function substr;

/**
 * Description
 */
class Example implements \IteratorAggregate
{
    private const VERSION = PHP_VERSION - (PHP_MINOR_VERSION * 100) - PHP_PATCH_VERSION;

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

        $this->bar = (string) $this->baxBax ?? substr($this->bar, stringLength($this->bar - $length));
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
