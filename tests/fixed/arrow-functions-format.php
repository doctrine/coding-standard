<?php

declare(strict_types=1);

$missingStatic = static fn ($a, $b) => $a + $b;

$uselessParentheses = static fn ($x) => $x + $y;

$withReturnType = static fn () => 1 + 2;

$withTypesInArguments = static fn (int $a, int $b) => $a + $b;

$spacing = static fn (int $x) => $x * 2;

$nested = static fn ($x) => static fn ($y) => $x * $y + $z;

$returningObject = static fn () => new stdClass();

$multiLineArrowFunctions = Collection::from([1, 2])
    ->map(
        static fn (int $v) => $v * 2,
    )
    ->reduce(
        static fn (int $tmp, int $v) => $tmp + $v,
    );

$thisIsNotAnArrowFunction = [$this->fn => 'value'];

$arrayWithArrowFunctions = [
    'true' => static fn () => true,
    'false' => static fn () => false,
];

$singleLineArrayReturn = Collection::map(
    static fn () => [1, 2],
);

$wrongMultiLineArrayReturn = Collection::map(
    static fn () => [
        1,
        2,
    ],
);
