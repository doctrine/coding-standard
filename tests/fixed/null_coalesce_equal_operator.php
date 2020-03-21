<?php

declare(strict_types=1);

$bar ??= 'bar';

$bar['baz'] ??= 'baz';

$bar ??= 'bar';

$object->property ??= 'Default Value';

Test::$foo ??= 123;
