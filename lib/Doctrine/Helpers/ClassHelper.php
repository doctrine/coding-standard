<?php

declare(strict_types=1);

namespace Doctrine\Helpers;

use function preg_match;

class ClassHelper
{
    public static function hasExceptionSuffix(string $className) : bool
    {
        return preg_match('/Exception$/', $className) === 1;
    }
}
