<?php

declare(strict_types=1);

namespace Doctrine\Helpers;

use PHP_CodeSniffer\Files\File;
use SlevomatCodingStandard\Helpers\TokenHelper;
use const T_COMMA;
use const T_EXTENDS;
use const T_OPEN_CURLY_BRACKET;
use function array_combine;
use function array_map;
use function count;
use function preg_grep;
use function trim;

class InheritanceHelper
{
    /**
     * @param string[] $extendedInterfaces
     */
    public static function hasExceptionInterface(array $extendedInterfaces) : bool
    {
        return count(preg_grep('/Exception$/', $extendedInterfaces)) > 0;
    }

    /**
     * @return string[]
     */
    public static function parseExtendedInterfaces(File $phpcsFile, int $pointer) : array
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

        $interfaceNames = array_map(function ($interfaceName) : string {
            return trim($interfaceName, '\\');
        }, $extendedInterfaces);

        return array_combine($interfaceNames, $extendedInterfaces);
    }
}
