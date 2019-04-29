<?php

declare(strict_types=1);

$simpleType = expression();
assert($simpleType instanceof Type);

$typeDeclaredAfterExpression = expression();
assert($typeDeclaredAfterExpression instanceof Type);

$typeDeclaredViaAssertion = expression();
assert($typeDeclaredViaAssertion instanceof Type);

$unionType = expression();
assert($unionType instanceof Type1 || $unionType instanceof Type2);

$intersectionType = expression();
assert($intersectionType instanceof Type1 && $intersectionType instanceof Type2);

$nullableType = expression();
assert($nullableType instanceof Type || $nullableType === null);

$multipleScalarTypes = expression();
assert(is_int($multipleScalarTypes) || is_float($multipleScalarTypes) || is_bool($multipleScalarTypes) || is_string($multipleScalarTypes) || is_array($multipleScalarTypes) || $multipleScalarTypes === null);

/** @var Potato $variableThatIsNowhereToBeFound */
