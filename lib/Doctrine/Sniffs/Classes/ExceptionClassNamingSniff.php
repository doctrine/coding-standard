<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Classes;

use Doctrine\Helpers\ClassHelper;
use Doctrine\Helpers\InheritanceHelper;
use Doctrine\Helpers\NamingHelper;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use const T_CLASS;
use function assert;

final class ExceptionClassNamingSniff implements Sniff
{
    public const CODE_NOT_EXTENDING_EXCEPTION = 'NotExtendingException';
    public const CODE_MISSING_SUFFIX          = 'MissingSuffix';
    public const CODE_SUPERFLUOUS_SUFFIX      = 'SuperfluousSuffix';

    /**
     * @return int[]|string[]
     */
    public function register() : array
    {
        return [T_CLASS];
    }

    /**
     * @param int $pointer
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     */
    public function process(File $phpcsFile, $pointer) : void
    {
        $declarationName = $phpcsFile->getDeclarationName($pointer);
        assert($declarationName !== null);

        $isAbstract       = ClassHelper::isAbstract($phpcsFile, $pointer);
        $extendsException = InheritanceHelper::classExtendsException($phpcsFile, $pointer);
        $hasSuffix        = NamingHelper::hasExceptionSuffix($declarationName);

        if (! $hasSuffix && ! $extendsException) {
            // class Foo
            // class Foo extends Bar
            // abstract class Foo
            // abstract class Foo extends Bar

            return;
        }

        if (! $hasSuffix && ! $isAbstract && $extendsException) {
            // class FooProblem extends BarException

            return;
        }

        if ($hasSuffix && $isAbstract && $extendsException) {
            // class FooException extends BarException

            return;
        }

        if ($hasSuffix && $isAbstract && ! $extendsException) {
            // abstract class FooException extends Bar

            $phpcsFile->addError(
                'Abstract exception must extend another exception.',
                $pointer,
                self::CODE_NOT_EXTENDING_EXCEPTION
            );

            return;
        }

        if (! $hasSuffix && $isAbstract && $extendsException) {
            // class Foo extends BarException

            $phpcsFile->addError(
                'Abstract exceptions must use the "Exception" suffix.',
                $pointer,
                self::CODE_MISSING_SUFFIX
            );

            return;
        }

        assert($hasSuffix && ! $isAbstract);

        // class FooException

        $phpcsFile->addError(
            'Leaf exception classes must not end with the "Exception" suffix.',
            $pointer,
            self::CODE_SUPERFLUOUS_SUFFIX
        );
    }
}
