<?php

declare(strict_types=1);

namespace Doctrine\Helpers;

use Throwable;
use function in_array;
use function preg_match;

final class NamingHelper
{
    public static function hasExceptionSuffix(string $className) : bool
    {
        return preg_match('~Exception$~', $className) === 1;
    }

    /**
     * @param string[] $names
     */
    public static function containsException(array $names) : bool
    {
        foreach ($names as $name) {
            if (! self::hasExceptionSuffix($name)) {
                continue;
            }

            return true;
        }

        return false;
    }

    /**
     * @param string[] $names
     */
    public static function containsThrowable(array $names) : bool
    {
        return in_array(Throwable::class, $names, true);
    }
}
