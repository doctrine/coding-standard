<?php

declare(strict_types=1);

$object = new stdClass();

$object->method();

$object->method()->nested();

$object
    ->method()
    ->nested();

$object
    ->method()
        ->doubleNested()
        ->stillNested()
                ->nestedTooFar()
        ->evenMoreLevels()
    ->notNested()
        ->nestedCorrectly();
