<?php

declare(strict_types=1);

namespace ExampleBackedEnum;

enum ExampleBackedEnum: int
{
    case FOO = 0;
    case BAR = 1;

    case BAZ = 2;

    /** Brevis, primus coordinataes foris promissio de varius, barbatus heuretes. */
    case BAM = 1234;
}
