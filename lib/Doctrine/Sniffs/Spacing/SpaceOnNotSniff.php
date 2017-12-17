<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Spacing;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

final class SpaceOnNotSniff implements Sniff
{
    use EnsureSpaces;

    private const MESSAGE = 'There must be a single space %s a NOT operator; %d found';

    public function register()
    {
        return [\T_BOOLEAN_NOT];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $this->ensureSpaceBefore($phpcsFile, $tokens, $stackPtr, self::MESSAGE);
        $this->ensureSpaceAfter($phpcsFile, $tokens, $stackPtr, self::MESSAGE);
    }
}
