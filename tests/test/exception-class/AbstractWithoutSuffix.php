<?php

declare(strict_types=1);

namespace Example;

abstract class AbstractWithoutSuffix extends My\Exception\FooNotFound implements \Throwable
{
}
