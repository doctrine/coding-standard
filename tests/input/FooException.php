<?php

declare(strict_types=1);

namespace Example;

use Namespacing\Classname;
use Throwable;

interface FooException extends Throwable, \Namespacing\Test, Classname
{
}
