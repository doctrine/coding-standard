<?php

declare(strict_types=1);

namespace Example;

use One\More\Classname1, My\Exception\MyException, Two\More\Classname2;

interface ValidHException extends Classname2, MyException, Classname1
{
}
