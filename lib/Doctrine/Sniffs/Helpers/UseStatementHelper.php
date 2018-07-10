<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Helpers;

use PHP_CodeSniffer\Files\File;
use SlevomatCodingStandard\Helpers\UseStatementHelper as UseHelper;

class UseStatementHelper
{
    /**
     * @return string[]
     */
    public static function getUseStatements(File $phpcsFile) : array
    {
        $importedClasses = [];
        foreach (UseHelper::getUseStatements($phpcsFile, 0) as $useStatement) {
            $importedClasses[$useStatement->getNameAsReferencedInFile()] = $useStatement->getFullyQualifiedTypeName();
        }

        return $importedClasses;
    }
}
