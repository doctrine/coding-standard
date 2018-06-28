<?php

declare(strict_types=1);

namespace Example;

class ValidD extends My\Exception\FooNotFound implements \MyOtherInterface, My\Exception\MyException
{
}
