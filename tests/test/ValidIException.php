<?php

declare(strict_types=1);

namespace Example;

use My\Exception\{MyException, Classname1};

interface ValidIException extends MyException, Classname1
{
}
