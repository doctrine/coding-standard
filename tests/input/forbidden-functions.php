<?php

declare(strict_types=1);

namespace Test;

use function chop;
use function is_null;
use function sizeof;

echo chop('abc ');
echo sizeof([1, 2, 3]);
echo is_null(456) ? 'y' : 'n';
