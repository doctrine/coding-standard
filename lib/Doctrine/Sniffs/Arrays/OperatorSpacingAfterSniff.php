<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Arrays;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\OperatorSpacingSniff as SquizOperatorSpacingSniff;
use PHP_CodeSniffer\Util\Tokens;
use const T_INLINE_ELSE;
use const T_INLINE_THEN;
use const T_INSTANCEOF;
use const T_STRING_CONCAT;
use const T_WHITESPACE;
use function array_merge;
use function array_unique;
use function strlen;

final class OperatorSpacingAfterSniff extends SquizOperatorSpacingSniff
{
    private const MESSAGE_AFTER = 'Expected exactly 1 space after "%s"; %d found';

    /**
     * {@inheritdoc}
     */
    public function register() : array
    {
        return array_unique(
            array_merge(
                Tokens::$comparisonTokens,
                Tokens::$operators,
                Tokens::$assignmentTokens,
                Tokens::$booleanOperators,
                [
                    T_INLINE_THEN,
                    T_INLINE_ELSE,
                    T_STRING_CONCAT,
                    T_INSTANCEOF,
                ]
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function process(File $phpcsFile, $pointer) : void
    {
        if (! $this->isOperator($phpcsFile, $pointer)) {
            return;
        }

        $tokens = $phpcsFile->getTokens();

        $this->ensureOneSpaceAfterOperator($phpcsFile, $pointer, $tokens);
    }

    /**
     * @param mixed[] $tokens
     */
    private function ensureOneSpaceAfterOperator(File $file, int $pointer, array $tokens) : void
    {
        if (! $this->shouldValidateAfter($pointer, $tokens)) {
            return;
        }

        $numberOfSpaces = $this->numberOfSpaces($tokens[$pointer + 1]);

        if ($numberOfSpaces === 1 || ! $this->recordErrorAfter($file, $pointer, $tokens[$pointer], $numberOfSpaces)) {
            return;
        }

        if ($numberOfSpaces === 0) {
            $file->fixer->addContent($pointer, ' ');
            return;
        }

        $file->fixer->replaceToken($pointer + 1, ' ');
    }

    /**
     * @param mixed[] $tokens
     */
    private function shouldValidateAfter(int $pointer, array $tokens) : bool
    {
        if (! isset($tokens[$pointer + 1])) {
            return false;
        }

        return $tokens[$pointer]['code'] !== T_INLINE_THEN || $tokens[$pointer + 1]['code'] !== T_INLINE_ELSE;
    }

    /**
     * @param mixed[] $token
     */
    private function recordErrorAfter(File $file, int $pointer, array $token, int $numberOfSpaces) : bool
    {
        return $file->addFixableError(
            self::MESSAGE_AFTER,
            $pointer,
            'NoSpaceAfter',
            [$token['content'], $numberOfSpaces]
        );
    }

    /**
     * @param mixed[] $token
     */
    private function numberOfSpaces(array $token) : int
    {
        if ($token['code'] !== T_WHITESPACE) {
            return 0;
        }

        return strlen($token['content']);
    }
}
