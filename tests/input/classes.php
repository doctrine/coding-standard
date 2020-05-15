<?php

declare(strict_types=1);

namespace Classes;

use Countable;

class A
{
}

/** Allow multiline class declarations */
final class ComplexClassDeclarationSoItNeedsToBeSplitAcrossMultipleLines
    extends A
    implements Countable
{
    public function count(): int
    {
        return 0;
    }
}
