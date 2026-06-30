<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;
use LogicException;
use RuntimeException;
use Throwable;

try {
    throw new Exception();
} catch (Throwable $throwable) {
}

try {
    throw new LogicException();
} catch (RuntimeException | LogicException) {
}
