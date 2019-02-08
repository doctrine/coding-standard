<?php

declare(strict_types=1);

static function (... $x) : void {
}
static function (int ... $x) : void {
}
static function ($x, ... $y) : void {
}
static function (int $x, int ... $y) : void {
}

foo(... $x);
foo($x, ... $y);
