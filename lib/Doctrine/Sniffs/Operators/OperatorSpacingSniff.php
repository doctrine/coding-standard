<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Operators;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\OperatorSpacingSniff as SquizOperatorSpacingSniff;
use PHP_CodeSniffer\Util\Tokens;
use function in_array;
use const T_ARRAY_CAST;
use const T_BOOL_CAST;
use const T_DOUBLE_CAST;
use const T_ECHO;
use const T_INT_CAST;
use const T_MINUS;
use const T_OBJECT_CAST;
use const T_PLUS;
use const T_PRINT;
use const T_STRING_CAST;
use const T_UNSET_CAST;
use const T_YIELD;

/**
 * We need this sniff until Squiz accepts fix for unary operands detection
 * https://github.com/squizlabs/PHP_CodeSniffer/pull/2640
 */
final class OperatorSpacingSniff extends SquizOperatorSpacingSniff
{
    private const NON_OPERAND_TOKENS = [
        T_ARRAY_CAST,
        T_BOOL_CAST,
        T_DOUBLE_CAST,
        T_ECHO,
        T_INT_CAST,
        T_OBJECT_CAST,
        T_PRINT,
        T_STRING_CAST,
        T_UNSET_CAST,
        T_YIELD,
    ];

    /**
     * @param int $pointer
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     */
    public function process(File $file, $pointer) : void
    {
        if (! $this->isOperator($file, $pointer)) {
            return;
        }

        parent::process($file, $pointer);
    }

    /**
     * @param int $pointer
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     */
    protected function isOperator(File $file, $pointer) : bool
    {
        if (! parent::isOperator($file, $pointer)) {
            return false;
        }

        $tokens = $file->getTokens();
        if ($tokens[$pointer]['code'] === T_MINUS || $tokens[$pointer]['code'] === T_PLUS) {
            $prev = $file->findPrevious(Tokens::$emptyTokens, $pointer - 1, null, true);
            if (in_array($tokens[$prev]['code'], self::NON_OPERAND_TOKENS, true)) {
                return false;
            }
        }

        return true;
    }
}
