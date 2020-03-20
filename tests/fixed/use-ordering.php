<?php

declare(strict_types=1);

namespace Foo;

use DateTimeImmutable;
use DateTimeInterface;

use function sprintf;

use const PHP_EOL;

echo sprintf('Current date and time is %s', (new DateTimeImmutable())->format(DateTimeInterface::ATOM)) . PHP_EOL;
