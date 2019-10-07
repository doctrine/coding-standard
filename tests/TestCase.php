<?php

declare(strict_types=1);

namespace Doctrine\Tests;

use SlevomatCodingStandard\Sniffs\TestCase as SlevomatTestCase;
use function str_replace;
use function strlen;
use function substr;

abstract class TestCase extends SlevomatTestCase
{
    protected static function getSniffClassName() : string
    {
        return str_replace('\\Tests\\', '\\', substr(static::class, 0, -strlen('Test')));
    }
}
