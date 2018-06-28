<?php

declare(strict_types=1);

namespace Example;

use My\Exception\FooNotFound;
use My\Exception\MyException;

abstract class ValidBException extends FooNotFound implements MyException
{
}
