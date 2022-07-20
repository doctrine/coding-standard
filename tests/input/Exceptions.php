<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;
use Throwable;

try {
    throw new Exception();
} catch (Throwable $throwable) {
}
