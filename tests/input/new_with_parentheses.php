<?php

declare(strict_types=1);

$foo = new \DateTimeImmutable;

$barClassName = 'Bar';
$bar = new $barClassName;

$classNamesInArray = ['Baz'];
$foo = new $classNamesInArray[0];

$classNamesInObject = new stdClass();
$classNamesInObject->foo = 'Foo';
$foo = new $classNamesInObject->foo;

$whitespaceBetweenClassNameAndParentheses = new stdClass   ;

$x = [
    new stdClass,
];

$y = [new stdClass];

$z = new stdClass ? new stdClass : new stdClass;

$q = $q ?: new stdClass;
$e = $e ?? new stdClass;
