<?php

declare(strict_types=1);

$foo = isset($_GET['foo']) ? $_GET['foo'] : 'foo';

$bar = isset($bar) ? $bar : 'bar';

$bar = isset($bar['baz']) ? $bar['baz'] : 'baz';

if (isset($foo)) {
    $bar = $foo;
} else {
    $bar = 'foo';
}

$fooBar = isset($foo, $bar) ? 'foo' : 'bar';

$baz = ! isset($foo) ? 'foo' : 'baz';
