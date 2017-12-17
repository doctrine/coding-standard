<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Spacing;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

final class SpaceOnReturnTypeSniff implements Sniff
{
    use EnsureSpaces;

    private const MESSAGE = 'There must be a single space %s the colon on return types; %d found';

    public function register()
    {
        return [\T_RETURN_TYPE];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens        = $phpcsFile->getTokens();
        $colonPosition = $this->findColonPosition($tokens, $stackPtr);

        $this->ensureSpaceBefore($phpcsFile, $tokens, $colonPosition, self::MESSAGE);
        $this->ensureSpaceAfter($phpcsFile, $tokens, $colonPosition, self::MESSAGE);
    }

    private function findColonPosition(array $tokens, int $position) : int
    {
        $colonPosition = $position;

        do {
            --$colonPosition;
        } while ($tokens[$colonPosition]['code'] !== T_COLON);

        return $colonPosition;
    }
}
