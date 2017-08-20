<?php
/*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
* "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
* LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
* A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
* OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
* SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
* LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
* DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
* THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
* (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
* OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*
* This software consists of voluntary contributions made by many individuals
* and is licensed under the MIT license. For more information, see
* <http://www.doctrine-project.org>.
*/

declare(strict_types=1);

namespace Doctrine\Sniffs\Spacing;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/**
 * Small modification on PSR2 sniff to allow a space before the NOT operator
 *
 * @see \PHP_CodeSniffer\Standards\PSR2\Sniffs\ControlStructures\ControlStructureSpacingSniff
 */
final class ControlStructureSniff implements Sniff
{
    private const OPENER_NAME    = 'parenthesis_opener';
    private const OPENER_MESSAGE = 'Expected no spaces after opening bracket; %s found';
    private const CLOSER_NAME    = 'parenthesis_closer';
    private const CLOSER_MESSAGE = 'Expected no spaces before closing bracket; %s found';

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            \T_IF,
            \T_WHILE,
            \T_FOREACH,
            \T_FOR,
            \T_SWITCH,
            \T_DO,
            \T_ELSE,
            \T_ELSEIF,
            \T_TRY,
            \T_CATCH,
        ];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ( ! isset($tokens[$stackPtr][self::OPENER_NAME], $tokens[$stackPtr][self::CLOSER_NAME])) {
            return;
        }

        $openerPosition = $tokens[$stackPtr][self::OPENER_NAME];
        $closerPosition = $tokens[$stackPtr][self::CLOSER_NAME];

        $this->validateParenthesisOpener($phpcsFile, $tokens, $stackPtr, $openerPosition);
        $this->validateParenthesisCloser($phpcsFile, $tokens, $stackPtr, $openerPosition, $closerPosition);
    }

    private function validateParenthesisOpener(File $file, array $tokens, int $position, int $openerPosition) : void
    {
        $nextTokenPosition = $openerPosition + 1;
        $nextToken         = $tokens[$nextTokenPosition];

        if ($nextToken['code'] !== T_WHITESPACE || $tokens[$nextTokenPosition + 1]['code'] === T_BOOLEAN_NOT) {
            return;
        }

        $spaces = $nextToken['length'];

        if (\strpos($nextToken['content'], $file->eolChar) !== false) {
            $spaces = 'newline';
        }

        $file->recordMetric($position, 'Spaces after control structure open parenthesis', $spaces);

        if ($spaces === 0) {
            return;
        }

        if ( ! $file->addFixableError(self::OPENER_MESSAGE, $nextTokenPosition, 'AfterOpenBrace', [$spaces])) {
            return;
        }

        $file->fixer->replaceToken($nextTokenPosition, '');
    }

    private function validateParenthesisCloser(
        File $file,
        array $tokens,
        int $position,
        int $openerPosition,
        int $closerPosition
    ) : void {
        if ($tokens[$openerPosition]['line'] !== $tokens[$closerPosition]['line']) {
            return;
        }

        $previousTokenPosition = $closerPosition - 1;
        $previousToken         = $tokens[$previousTokenPosition];
        $spaces                = 0;

        if ($previousToken['code'] === T_WHITESPACE) {
            $spaces = $previousToken['length'];
        }

        $file->recordMetric($position, 'Spaces before control structure close parenthesis', $spaces);

        if ($spaces === 0) {
            return;
        }

        if ( ! $file->addFixableError(self::CLOSER_MESSAGE, $previousTokenPosition, 'BeforeCloseBrace', [$spaces])) {
            return;
        }

        $file->fixer->replaceToken($previousTokenPosition, '');
    }
}
