<?php

declare(strict_types=1);

namespace Example;

use Some\OtherInterface as Throwable;
use Test1;

interface DifferentThrowableException extends This\Is\Not\Throwable
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

interface NotThrowableException extends Throwable
{
}