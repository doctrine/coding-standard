<?php

declare(strict_types=1);

namespace Test;

use function chop;
use function is_null;
use function settype;
use function sizeof;
use function var_dump;

echo chop('abc ');
echo sizeof([1, 2, 3]);
echo is_null(456) ? 'y' : 'n';

$foo = '1';
settype($foo, 'int');
var_dump($foo);
