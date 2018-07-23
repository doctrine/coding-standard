<?php

declare(strict_types=1);

namespace Example;

use My\Throwable;

abstract class AbstractWithoutSuffix extends My\Exception\FooNotFound implements \Throwable
{
}

abstract class DifferentThrowableException extends Nothing implements Throwable
{
}

abstract class InheritsNothingException
{
}

final class NotAbstractException extends My\Exception\FooNotFound implements \Throwable
{
}

class NotFinal extends \Exception
{
}