<?php

declare(strict_types=1);

namespace ReadonlyClass;

use function trim;

// phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses, Squiz.Classes.ClassFileName.NoMatch

final readonly class ReadonlyClass
{
    public string $value;

    public function __construct(string $value)
    {
        $this->value = trim($value);
    }
}

trait TracksChanges
{
    public int $changes = 0;
}

final class TrackedName
{
    use TracksChanges;

    public readonly string $value;
}
