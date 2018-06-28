<?php

declare(strict_types=1);

namespace Example;

class NotAbstractException extends My\Exception\FooNotFound implements \Throwable
{
}
