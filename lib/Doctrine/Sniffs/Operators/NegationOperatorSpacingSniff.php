<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Operators;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use SlevomatCodingStandard\Helpers\TokenHelper;
use function in_array;
use function strlen;
use const T_CLOSE_PARENTHESIS;
use const T_CLOSE_SHORT_ARRAY;
use const T_CLOSE_SQUARE_BRACKET;
use const T_CONSTANT_ENCAPSED_STRING;
use const T_DNUMBER;
use const T_ENCAPSED_AND_WHITESPACE;
use const T_LNUMBER;
use const T_MINUS;
use const T_NUM_STRING;
use const T_STRING;
use const T_VARIABLE;
use const T_WHITESPACE;

final class NegationOperatorSpacingSniff implements Sniff
{
    public const CODE_INVALID_SPACE_AFTER_MINUS = 'InvalidSpaceAfterMinus';

    /** @var bool */
    public $requireSpace = false;

    /**
     * {@inheritdoc}
     */
    public function register() : array
    {
        return [T_MINUS];
    }

    /**
     * @param int $pointer
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     */
    public function process(File $file, $pointer) : void
    {
        $tokens = $file->getTokens();

        $previousEffective = TokenHelper::findPreviousEffective($file, $pointer - 1);

        $possibleOperandTypes = [
            T_CONSTANT_ENCAPSED_STRING,
            T_CLOSE_PARENTHESIS,
            T_CLOSE_SHORT_ARRAY,
            T_CLOSE_SQUARE_BRACKET,
            T_DNUMBER,
            T_ENCAPSED_AND_WHITESPACE,
            T_LNUMBER,
            T_NUM_STRING,
            T_STRING,
            T_VARIABLE,
        ];

        if (in_array($tokens[$previousEffective]['code'], $possibleOperandTypes, true)) {
            return;
        }

        $whitespacePointer = $pointer + 1;
        if (! isset($tokens[$whitespacePointer])) {
            return;
        }

        $numberOfSpaces = $this->numberOfSpaces($tokens[$whitespacePointer]);
        $expectedSpaces = $this->requireSpace ? 1 : 0;

        if ($numberOfSpaces === $expectedSpaces
            || ! $this->recordError($file, $pointer, $tokens[$pointer], $expectedSpaces, $numberOfSpaces)) {
            return;
        }

        if ($expectedSpaces > $numberOfSpaces) {
            $file->fixer->addContent($pointer, ' ');

            return;
        }

        $file->fixer->replaceToken($whitespacePointer, '');
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

    /**
     * @param mixed[] $token
     */
    private function recordError(File $file, int $pointer, array $token, int $expected, int $found) : bool
    {
        return $file->addFixableError(
            'Expected exactly %d space after "%s"; %d found',
            $pointer,
            self::CODE_INVALID_SPACE_AFTER_MINUS,
            [$expected, $token['content'], $found]
        );
    }
}
