<?php

declare(strict_types=1);

namespace Example;

use Throwable;
use Test1;
use TestException;

interface ValidEException extends Test1, Throwable, TestException
{
}
