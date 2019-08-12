<?php

declare(strict_types=1);

namespace Foo;

use function sprintf;
use DateTimeImmutable;
use const PHP_EOL;
use DateTimeInterface;

echo sprintf('Current date and time is %s', (new DateTimeImmutable())->format(DateTimeInterface::ATOM)) . PHP_EOL;
