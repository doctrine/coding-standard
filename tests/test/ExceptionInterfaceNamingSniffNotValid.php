<?php

declare(strict_types=1);

namespace Example;

use This\Is\Not\Throwable;
use Test1;

interface DifferentThrowableException extends Throwable
{
}

interface ExtendedsNothingException
{
}

interface NoExtendedException extends Test1
{
}

interface NoSuffix extends \Throwable
{
}