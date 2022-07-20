<?php

declare(strict_types=1);

namespace Doctrine;

use function var_dump;

// phpcs:disable PSR1.Files.SideEffects

class TrailingCommaOnFunctions
{
    public function a(int $arg,): void
    {
    }

    public function b(
        int $arg
    ): void {
    }

    public function uses(): void
    {
        $var = null;

        $singleLine = static function (int $arg) use ($var,): void {
            var_dump($var);
        };

        $multiLine = static function (int $arg) use (
            $var
        ): void {
            var_dump($var);
        };
    }
}

$class = new TrailingCommaOnFunctions();

// phpcs:ignore Generic.Functions.FunctionCallArgumentSpacing.NoSpaceAfterComma
$class->a(1,);

$class->a(
    1
);
