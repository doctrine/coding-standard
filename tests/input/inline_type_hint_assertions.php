<?php

declare(strict_types=1);

final class Foo
{
    public function methodWithInlineHints()
    {
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

        /** @var int|float|bool|string|null|array $multipleScalarTypes */
        $multipleScalarTypes = expression();
    }
}
