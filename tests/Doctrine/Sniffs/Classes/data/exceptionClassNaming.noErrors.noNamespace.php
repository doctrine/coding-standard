<?php

declare(strict_types=1);

use LogicException as NotLogical;

final class Imported extends Exception
{
}

abstract class ImportedException extends Exception
{
}


final class ExtendsAlias extends NotLogical
{
}

class RegularClassToIgnore
{
}
