<?php

declare(strict_types=1);

namespace Doctrine\Helpers;

use PHP_CodeSniffer\Files\File;
use SlevomatCodingStandard\Helpers\NamespaceHelper;
use SlevomatCodingStandard\Helpers\UseStatementHelper as UseHelper;
use function array_map;
use function ltrim;
use function sprintf;

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
     * @param string[] $referencedNames
     *
     * @return string[]
     */
    public static function getRealNames(File $phpcsFile, int $pointer, array $referencedNames) : array
    {
        $uses             = self::getUseStatements($phpcsFile);
        $currentNamespace = NamespaceHelper::findCurrentNamespaceName($phpcsFile, $pointer);

        return array_map(function (string $extendedInterface) use ($uses, $currentNamespace) : string {
            if ($extendedInterface[0] === '\\') {
                return ltrim($extendedInterface, '\\');
            }

            if (isset($uses[$extendedInterface])) {
                return ltrim($uses[$extendedInterface], '\\');
            }

            if ($currentNamespace === null) {
                return $extendedInterface;
            }

            return sprintf('%s\\%s', $currentNamespace, $extendedInterface);
        }, $referencedNames);
    }

    public static function getRealName(File $phpcsFile, string $referencedName) : string
    {
        $uses = self::getUseStatements($phpcsFile);
        return $uses[$referencedName] ?? $referencedName;
    }
}
