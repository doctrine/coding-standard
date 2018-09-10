<?php

declare(strict_types=1);

namespace Doctrine\Helpers;

use PHP_CodeSniffer\Files\File;
use SlevomatCodingStandard\Helpers\TokenHelper;
use const T_COMMA;
use const T_EXTENDS;
use const T_OPEN_CURLY_BRACKET;
use function trim;

class InheritanceHelper
{
    /**
     * @return string[]
     */
    public static function getExtendedInterfaces(File $phpcsFile, int $pointer) : array
    {
        $limit = TokenHelper::findNext($phpcsFile, [T_OPEN_CURLY_BRACKET], $pointer) - 1;
        $start = TokenHelper::findNext($phpcsFile, [T_EXTENDS], $pointer + 1, $limit);

        if ($start === null) {
            return [];
        }

        $extendedInterfaces = [];
        do {
            $localEnd             = TokenHelper::findNextLocal($phpcsFile, [T_COMMA], $start + 1, $limit) ?? $limit;
            $extendedInterfaces[] = trim(TokenHelper::getContent($phpcsFile, $start + 1, $localEnd - 1));
            $start                = $localEnd;
        } while ($start < $limit);

        return UseStatementHelper::getRealNames($phpcsFile, $pointer, $extendedInterfaces);
    }

    public static function classExtendsException(File $phpcsFile, int $pointer) : bool
    {
        $extendedName = $phpcsFile->findExtendedClassName($pointer);

        if ($extendedName === false) {
            return false;
        }

        return NamingHelper::hasExceptionSuffix(UseStatementHelper::getRealName($phpcsFile, $extendedName));
    }
}
