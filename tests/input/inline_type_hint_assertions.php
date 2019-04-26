<?php

declare(strict_types=1);

/** @var Type $simpleType */
$simpleType = expression();

$typeDeclaredAfterExpression = expression();
/** @var Type $typeDeclaredAfterExpression */

$typeDeclaredViaAssertion = expression();
assert($typeDeclaredViaAssertion instanceof Type);

/** @var Type1|Type2 $unionType */
$unionType = expression();

/** @var Type1&Type2 $intersectionType */
$intersectionType = expression();

/** @var Type|null $nullableType */
$nullableType = expression();

/** @var int|float|bool|string|array|null $multipleScalarTypes */
$multipleScalarTypes = expression();

/** @var Potato $variableThatIsNowhereToBeFound */
