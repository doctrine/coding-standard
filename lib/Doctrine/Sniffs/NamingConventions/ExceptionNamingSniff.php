<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

use function trim;
use function ucfirst;

use const T_CLASS;
use const T_STRING;

class ExceptionNamingSniff implements Sniff
{
    /**
     * @return array<int, (int|string)>
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingNativeTypeHint
     */
    public function register()
    {
        return [T_CLASS];
    }

    /**
     * @param int $stackPtr
     *
     * @return void
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingNativeTypeHint
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $className = $phpcsFile->findNext(T_STRING, $stackPtr);
        $name      = trim($tokens[$className]['content']);
        $errorData = [ucfirst($tokens[$stackPtr]['content'])];

        switch ($name) {
            case 'Exception':
                $phpcsFile->addError(
                    'Using Exception as a short class name is not allowed.',
                    $stackPtr,
                    'Invalid',
                    $errorData
                );
                break;
        }
    }
}
