<?php

declare(strict_types=1);

namespace Doctrine\Helpers;

use PHP_CodeSniffer\Files\File;

class ClassHelper
{
    public static function isAbstract(File $phpcsFile, int $classPointer) : bool
    {
        return $phpcsFile->getClassProperties($classPointer)['is_abstract'];
    }
}
