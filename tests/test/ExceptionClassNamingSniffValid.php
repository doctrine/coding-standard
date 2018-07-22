<?php

declare(strict_types=1);

namespace Example;

use Exception;
use My\Classname\Foo;
use My\Exception\MyException;
use My\Exception\{GroupedException, OtherGroupedException};
use My\Exception\OnelineException, My\Exception\OtherOnelineException;

final class Imported extends Exception
{
}

abstract class ImportedException extends Exception
{
}

final class Fqcn extends \Exception
{
}

abstract class FqcnException extends \Exception
{
}

abstract class InterfaceUsedException extends Foo implements MyException
{
}

final class GroupedUse extends GroupedException
{
}

final class ImportedInOneLine extends OnelineException
{
}

class RegularClassToIgnore
{
}