<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Spacing;

use PHP_CodeSniffer\Files\File;

trait EnsureSpaces
{
    protected function ensureSpaceBefore(File $file, array $tokens, int $position, string $message) : void
    {
        $spacing = $this->numberOfSpaces($tokens, $position - 1);

        if ($spacing === 1) {
            return;
        }

        if (! $file->addFixableError($message, $position, 'before', ['before', $spacing])) {
            return;
        }

        if ($spacing === 0) {
            $file->fixer->addContentBefore($position, ' ');
            return;
        }

        $file->fixer->replaceToken($position - 1, ' ');
    }

    protected function ensureSpaceAfter(File $file, array $tokens, int $position, string $message) : void
    {
        $spacing = $this->numberOfSpaces($tokens, $position + 1);

        if ($spacing === 1) {
            return;
        }

        if (! $file->addFixableError($message, $position, 'after', ['after', $spacing])) {
            return;
        }

        if ($spacing === 0) {
            $file->fixer->addContent($position, ' ');
            return;
        }

        $file->fixer->replaceToken($position + 1, ' ');
    }

    private function numberOfSpaces(array $tokens, int $position) : int
    {
        $token = $tokens[$position];

        return $token['code'] === T_WHITESPACE ? $token['length'] : 0;
    }
}
