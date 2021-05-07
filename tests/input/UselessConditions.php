<?php

declare(strict_types=1);

namespace Conditions;

use function count;
use function strpos;

class UselessConditions
{
    public function uselessCondition(): bool
    {
        if ($foo === 'foo') {
            return true;
        } else {
            return false;
        }
    }

    public function uselessIfCondition(): bool
    {
        if ($bar === 'bar') {
            return true;
        }

        return false;
    }

    public function uselessNegativeCondition(): bool
    {
        if ($foo !== 'foo') {
            return false;
        } else {
            return true;
        }
    }

    public function uselessIfNegativeCondition(): bool
    {
        if ($bar === 'bar') {
            return false;
        }

        return true;
    }

    public function unecessaryIfMethodForEarlyReturn(): bool
    {
        if ($bar === 'bar') {
            return false;
        }

        if ($foo === 'foo') {
            return false;
        }

        if ($baz === 'baz') {
            return false;
        }

        return true;
    }

    public function uselessIfConditionWithParameter(bool $bool): bool
    {
        if ($bool) {
            return false;
        }

        return true;
    }

    public function uselessIfConditionWithBoolMethod(): bool
    {
        if ($this->isTrue()) {
            return false;
        }

        return true;
    }

    public function uselessIfConditionWithComplexIf(): bool
    {
        if ($bar === 'bar' && $foo === 'foo' && $baz !== 'quox') {
            return true;
        } else {
            return false;
        }
    }

    public function uselessIfConditionWithEvenMoreComplexIf(): bool
    {
        if ($bar === 'bar' || $foo === 'foo' || $baz !== 'quox') {
            return true;
        } else {
            return false;
        }
    }

    public function uselessIfConditionWithComplexCondition(): bool
    {
        if ($bar === 'bar' || $foo === 'foo' || $baz !== 'quox') {
            return false;
        }

        return true;
    }

    public function uselessIfConditionWithTernary(): bool
    {
        if ($this->isTrue()) {
            return $this->isTrulyTrue() ? true : false;
        } else {
            return false;
        }
    }

    public function necessaryIfConditionWithMethodCall(): bool
    {
        if ($this->shouldBeQueued()) {
            $this->queue();

            return true;
        }

        return false;
    }

    public function nullShouldNotBeTreatedAsFalse(): ?bool
    {
        if (! $this->isAdmin) {
            return null;
        }

        return true;
    }

    public function uselessTernary(): bool
    {
        return $foo !== 'bar' ? true : false;
    }

    public function uselessTernaryWithParameter(bool $condition): bool
    {
        return $condition ? true : false;
    }

    public function uselessTernaryWithMethod(): bool
    {
        return $this->isFalse() ? true : false;
    }

    /** @param string[] $words */
    public function uselessTernaryCheck(array $words): bool
    {
        return count($words) >= 1 ? false : true;
    }

    public function necessaryTernary(): int
    {
        return strpos('foo', 'This is foo and bar') !== false ? 1 : 0;
    }
}
