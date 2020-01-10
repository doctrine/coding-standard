<?php

declare(strict_types=1);

namespace Test;

use function chop;
use function compact;
use function extract;
use function is_null;
use function settype;
use function sizeof;
use function trigger_error;
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

trigger_error(
    'Do not use runtime errors as a way to convey deprecations to users. '
    . 'Warnings, notices, and errors in general (which aren\'t exceptions) are not usable '
    . 'in downstream projects, and propagate to global error handlers, causing massive issues '
    . 'in anything relying on STDOUT, STDERR, aggressive logging, or just expects decent performance '
    . 'from a dependency. In addition to that, introducing additional runtime effects is a potential '
    . 'BC break'
);
