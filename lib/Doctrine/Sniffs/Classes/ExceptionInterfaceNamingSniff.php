<?php

declare(strict_types=1);

namespace Doctrine\Sniffs\Classes;

use Doctrine\Helpers\InheritanceHelper;
use Doctrine\Helpers\NamingHelper;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use const T_INTERFACE;

final class ExceptionInterfaceNamingSniff implements Sniff
{
    private const CODE_NOT_AN_EXCEPTION = 'NotAnException';

    /**
     * @return int[]|string[]
     */
    public function register() : array
    {
        return [T_INTERFACE];
    }

    /**
     * @param int $pointer
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     */
    public function process(File $phpcsFile, $pointer) : void
    {
        $declarationName    = $phpcsFile->getDeclarationName($pointer);
        $extendedInterfaces = InheritanceHelper::getExtendedInterfaces($phpcsFile, $pointer);
        $extendsThrowable   = NamingHelper::containsThrowable($extendedInterfaces);
        $hasSuffix          = NamingHelper::hasExceptionSuffix((string) $declarationName);

        if ($hasSuffix && $extendsThrowable) {
            // interface FooException extends Throwable
            return;
        }

        // assumes that an interface with the "Exception" suffix is a valid exception interface
        $extendsException = NamingHelper::containsException($extendedInterfaces);

        if ($hasSuffix && $extendsException) {
            // interface FooException extends BarException
            return;
        }

        if ($hasSuffix && ! $extendsException && ! $extendsThrowable) {
            // interface FooException
            $phpcsFile->addError(
                'Exception interface must extend another exception interface or Throwable.',
                $pointer,
                self::CODE_NOT_AN_EXCEPTION
            );

            return;
        }

        if (! $extendsException && ! $extendsThrowable) {
            return;
        }

        // interface Foo extends Throwable
        // interface Foo extends BarException
        $phpcsFile->addError(
            'Exception interface must end with the "Exception" name suffix.',
            $pointer,
            self::CODE_NOT_AN_EXCEPTION
        );
    }
}
