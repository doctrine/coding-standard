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

trait EnsureSpaces
{
    protected function ensureSpaceBefore(File $file, array $tokens, int $position, string $message) : void
    {
        $spacing = $this->numberOfSpaces($tokens, $position - 1);

        if ($spacing === 1) {
            return;
        }

        if ( ! $file->addFixableError($message, $position, 'before', ['before', $spacing])) {
            return;
        }

        if ($spacing === 0) {
            $file->fixer->addContentBefore($position, ' ');
            return;
        }

        $file->fixer->replaceToken($position - 1, ' ');
    }

    protected function ensureSpaceAfter(File $file, array $tokens, int $position, string $message) : void
    {
        $spacing = $this->numberOfSpaces($tokens, $position + 1);

        if ($spacing === 1) {
            return;
        }

        if ( ! $file->addFixableError($message, $position, 'after', ['after', $spacing])) {
            return;
        }

        if ($spacing === 0) {
            $file->fixer->addContent($position, ' ');
            return;
        }

        $file->fixer->replaceToken($position + 1, ' ');
    }

    private function numberOfSpaces(array $tokens, int $position) : int
    {
        $token = $tokens[$position];

        return $token['code'] === T_WHITESPACE ? $token['length'] : 0;
    }
}
