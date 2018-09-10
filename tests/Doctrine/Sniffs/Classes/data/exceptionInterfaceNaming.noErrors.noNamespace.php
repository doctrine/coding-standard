<?php

declare(strict_types=1);

use Throwable as ThrowableAliased;
use MyException as MyExceptionAliased;

interface ThrowableException extends Throwable
{
}

interface ImportedInterfaceException extends MyException
{
}

interface AliasedException extends MyExceptionAliased
{
}

interface ExtendingMultipleInterfacesException extends Test1, Throwable, TestException
{
}

interface ThrowableAliasException extends ThrowableAliased
{
}

interface RegularInterface
{
}
