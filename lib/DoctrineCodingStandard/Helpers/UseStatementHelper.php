<?php

declare(strict_types=1);

namespace DoctrineCodingStandard\Helpers;

use PHP_CodeSniffer\Files\File;
use SlevomatCodingStandard\Helpers\UseStatementHelper as UseHelper;
use Throwable;
use function in_array;

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

    /**
     * @param string[] $importedClassNames
     * @param string[] $implementedInterfaces
     */
    public static function isImplementingThrowable(array $importedClassNames, array $implementedInterfaces) : bool
    {
        return (in_array(Throwable::class, $importedClassNames, true) &&
            in_array(Throwable::class, $implementedInterfaces, true)) ||
            in_array('\\' . Throwable::class, $implementedInterfaces, true);
    }
}
