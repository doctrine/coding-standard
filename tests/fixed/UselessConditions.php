<?php

declare(strict_types=1);

namespace Conditions;

use function count;
use function strpos;

class UselessConditions
{
    public function uselessCondition() : bool
    {
        return $foo === 'foo';
    }

    public function uselessIfCondition() : bool
    {
        return $bar === 'bar';
    }

    public function uselessNegativeCondition() : bool
    {
        return $foo === 'foo';
    }

    public function uselessIfNegativeCondition() : bool
    {
        return $bar !== 'bar';
    }

    public function unecessaryIfMethodForEarlyReturn() : bool
    {
        if ($bar === 'bar') {
            return false;
        }

        if ($foo === 'foo') {
            return false;
        }

        return $baz !== 'baz';
    }

    public function uselessIfConditionWithParameter(bool $bool) : bool
    {
        return ! $bool;
    }

    public function uselessIfConditionWithBoolMethod() : bool
    {
        return ! $this->isTrue();
    }

    public function uselessIfConditionWithComplexIf() : bool
    {
        return $bar === 'bar' && $foo === 'foo' && $baz !== 'quox';
    }

    public function uselessIfConditionWithEvenMoreComplexIf() : bool
    {
        return $bar === 'bar' || $foo === 'foo' || $baz !== 'quox';
    }

    public function uselessIfConditionWithComplexCondition() : bool
    {
        return $bar !== 'bar' && $foo !== 'foo' && $baz === 'quox';
    }

    public function uselessIfConditionWithTernary() : bool
    {
        if ($this->isTrue()) {
            return $this->isTrulyTrue();
        }

        return false;
    }

    public function necessaryIfConditionWithMethodCall() : bool
    {
        if ($this->shouldBeQueued()) {
            $this->queue();

            return true;
        }

        return false;
    }

    public function nullShouldNotBeTreatedAsFalse() : ?bool
    {
        if (! $this->isAdmin) {
            return null;
        }

        return true;
    }

    public function uselessTernary() : bool
    {
        return $foo !== 'bar';
    }

    public function uselessTernaryWithParameter(bool $condition) : bool
    {
        return $condition;
    }

    public function uselessTernaryWithMethod() : bool
    {
        return $this->isFalse();
    }

    /**
     * @param string[] $words
     */
    public function uselessTernaryCheck(array $words) : bool
    {
        return count($words) < 1;
    }

    public function necessaryTernary() : int
    {
        return strpos('foo', 'This is foo and bar') !== false ? 1 : 0;
    }
}
