<?php

declare(strict_types=1);

namespace Doctrine;

class TrailingCommaOnFunctions
{
    public function a(int $arg): void
    {
    }

    public function b(
        int $arg
    ): void {
    }
}
