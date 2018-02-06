<?php

declare(strict_types=1);

$foo = $_GET['foo'] ?? 'foo';

$bar = $bar ?? 'bar';

$bar = $bar['baz'] ?? 'baz';

if (isset($foo)) {
    $bar = $foo;
} else {
    $bar = 'foo';
}

$fooBar = isset($foo, $bar) ? 'foo' : 'bar';

$baz = ! isset($foo) ? 'foo' : 'baz';
