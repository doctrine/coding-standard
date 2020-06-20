<?php

declare(strict_types=1);

namespace Test;

use function array_map;
use function chop;
use function compact;
use function extract;
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

$bar = [
    'foo' => 1,
    'bar' => 2,
    'baz' => 3,
];
extract($bar);

compact('foo', 'bar');

array_map('is_null', ['1', '2', null]); // forbidden function will not be detected
