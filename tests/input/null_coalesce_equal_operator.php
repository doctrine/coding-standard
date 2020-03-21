<?php

declare(strict_types=1);

$bar = $bar ?? 'bar';

$bar['baz'] = $bar['baz'] ?? 'baz';

$bar = isset($bar) ? $bar : 'bar';

$object->property = $object->property ?? 'Default Value';

Test::$foo = Test::$foo ?? 123;
