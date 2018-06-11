<?php

declare(strict_types=1);

namespace Types;

class LowCaseTypes
{
    public function stringToInt(string $string) : int
    {
        return (int) $string;
    }

    public function returnString() : string
    {
        return 'foo';
    }
}
