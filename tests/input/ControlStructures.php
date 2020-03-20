<?php

declare(strict_types=1);

namespace ControlStructures;

use InvalidArgumentException;
use Throwable;

use const PHP_VERSION;

class ControlStructures
{
    private const VERSION = PHP_VERSION;

    /**
     * @return iterable<int>
     */
    public function varAndIfNoSpaceBetween(): iterable
    {
        $var = 1;
        if (self::VERSION === 0) {
            yield 0;
        }
    }

    /**
     * @return iterable<int>
     */
    public function ifAndYieldSpaceBetween(): iterable
    {
        if (self::VERSION === 0) {
            yield 0;
        }
        yield 1;
    }

    /**
     * @return iterable<int>
     */
    public function ifAndYieldFromSpaceBetween(): iterable
    {
        if (self::VERSION === 0) {
            yield 0;
        }
        yield from [];
    }

    public function ifAndThrowSpaceBetween(): void
    {
        if (self::VERSION === 0) {
            return;
        }
        throw new InvalidArgumentException();
    }

    public function ifAndReturnSpaceBetween(): int
    {
        if (self::VERSION === 0) {
            return 0;
        }

        return 1;
    }

    public function noSpaceAroundCase(): void
    {
        switch (self::VERSION) {
            case 1:
            case 2:
                // do something
                break;
            case 3:
                // do something else
                break;
            default:
        }
    }

    public function spaceBelowBlocks(): void
    {
        if (true) {
            echo 1;
        }
        do {
            echo 2;
        } while (true);
        while (true) {
            echo 3;
        }
        for ($i = 0; $i < 1; $i++) {
            echo $i;
        }
        foreach ([] as $item) {
            echo $item;
        }
        switch (true) {
            default:
        }
        try {
            echo 4;
        } catch (Throwable $throwable) {
        }
        echo 5;
    }

    public function spaceAroundMultilineIfs(): void
    {
        if (true
        && false) {
            echo 1;
        } elseif ( false
            || true
        ) {
            echo 2;
        }
    }
}
