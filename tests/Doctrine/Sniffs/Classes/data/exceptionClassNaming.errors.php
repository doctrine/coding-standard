<?php

declare(strict_types=1);

namespace Example;

use My\Throwable;

abstract class AbstractWithoutSuffix extends FooException implements \Throwable
{
}

abstract class ExtendsNoException extends Nothing
{
}

abstract class InheritsNothingException
{
}

final class NotAbstractException extends My\Exception\FooException implements \Throwable
{
}
