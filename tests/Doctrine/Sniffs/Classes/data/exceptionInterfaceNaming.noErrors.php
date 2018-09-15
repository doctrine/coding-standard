<?php

declare(strict_types=1);

namespace Example;

use My\Exception\MyException as MyAlias;
use My\Exception\MyException;
use My\Exception\{MyGroupedException, Classname3};
use One\More\Classname1, My\Exception\MyOnelineException, Two\More\Classname2;
use Test1;
use TestException;
use Throwable as ThrowableAlias;
use Throwable;

interface ThrowableException extends Throwable
{
}

interface FqcnThrowableException extends \Throwable
{
}

interface ImportedInterfaceException extends MyException
{
}

interface FqcnException extends My\Exception\MyException
{
}

interface ExtendingMultipleInterfacesException extends Test1, Throwable, TestException
{
}

interface ThrowableAliasException extends ThrowableAlias
{
}

interface MyAliasException extends MyAlias
{
}

interface OneLineImportHException extends Classname2, MyOnelineException, Classname1
{
}

interface GroupedImportException extends MyGroupedException, Classname3
{
}

interface RegularInterface
{
}
