<?php

declare(strict_types=1);

namespace Foo;

use DateInterval;
use DateTimeImmutable;
use DateTimeZone;
use const DATE_RFC3339;
use function strrev;
use function time;

strrev(
    (new DateTimeImmutable('@' . time(), new DateTimeZone('UTC')))
        ->sub(new DateInterval('P1D'))
        ->format(DATE_RFC3339)
);
