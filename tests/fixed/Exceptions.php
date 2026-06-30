<?php

declare(strict_types=1);

namespace Exceptions;

use Exception;
use LogicException;
use RuntimeException;
use Throwable;

try {
    throw new Exception();
} catch (Throwable) {
}

try {
    throw new LogicException();
} catch (LogicException | RuntimeException) {
}
