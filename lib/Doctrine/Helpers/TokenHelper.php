<?php

declare(strict_types=1);

namespace Doctrine\Helpers;

use PHP_CodeSniffer\Files\File;
use SlevomatCodingStandard\Helpers\TokenHelper as SlevomatTokenHelper;

class TokenHelper
{
    /**
     * @return int|string|null
     */
    public static function findPreviousToken(File $phpcsFile, int $pointer)
    {
        $previousPointer = SlevomatTokenHelper::findPreviousEffective($phpcsFile, $pointer - 1);
        $token           = $phpcsFile->getTokens()[$previousPointer]['code'];

        return $token === false ? null : $token;
    }
}
