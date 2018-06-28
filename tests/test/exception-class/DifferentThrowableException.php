<?php

declare(strict_types=1);

namespace Example;

use My\Throwable;

abstract class DifferentThrowableException extends Nothing implements Throwable
{
}
