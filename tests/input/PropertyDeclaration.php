<?php

declare(strict_types=1);

namespace Spacing;

final class PropertyDeclaration
{
    public bool $boolPropertyWithDefaultValue  = false;
    public string  $stringProperty;
    public  int $intProperty;
    public ? string $nullableString = null;

    public function __construct(
        public  readonly  Foo  $foo,
    ) {
    }
}
