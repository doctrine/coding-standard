<?php

declare(strict_types=1);

namespace Example;

use My\Exception\FooNotFound;
use My\Exception\MyException;

class ValidB extends FooNotFound implements MyException
{
}
