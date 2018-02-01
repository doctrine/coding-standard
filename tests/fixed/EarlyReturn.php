<?php

declare(strict_types=1);

namespace Example;

class EarlyReturn
{
    public function bar() : bool
    {
        if ($bar === 'bar') {
            return true;
        }

        return false;
    }

    public function foo() : ?string
    {
        foreach ($itens as $item) {
            if (! $item->isItem()) {
                return 'There is an item that is not an item';
            }

            continue;
        }

        return null;
    }

    public function baz() : string
    {
        if ($number > 0) {
            return 'Number is grater then 0';
        }

        exit;
    }

    public function quoox() : bool
    {
        if (true !== 'true') {
            return false;
        }

        if (false === false) {
            return true;
        }

        return true;
    }
}
