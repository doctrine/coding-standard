<?php

declare(strict_types=1);

namespace DoctrineCodingStandard\Helpers;

use PHP_CodeSniffer\Files\File;
use SlevomatCodingStandard\Helpers\TokenHelper;
use const T_EXTENDS;
use const T_OPEN_CURLY_BRACKET;
use function array_combine;
use function array_map;
use function count;
use function explode;
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
    public static function parseExtendedInterfaces(File $phpcsFile, int $stackPtr) : array
    {
        $limit = TokenHelper::findNext($phpcsFile, [T_OPEN_CURLY_BRACKET], $stackPtr) - 1;
        $start = TokenHelper::findNext($phpcsFile, [T_EXTENDS], $stackPtr + 1, $limit);

        if ($start === null) {
            return [];
        }

        $extendedInterfaces = explode(',', $phpcsFile->getTokensAsString($start + 1, $limit - $start));

        $extendedInterfaces = array_map('trim', $extendedInterfaces);
        $interfaceNames     = array_map(function ($interfaceName) : string {
            return trim($interfaceName, '\\');
        }, $extendedInterfaces);

        return array_combine($interfaceNames, $extendedInterfaces);
    }
}
