<?php

$config = new Doctrine\CodingStandard\Config();
$config->getFinder()
    ->in(__DIR__ . '/lib')
    ->in(__DIR__ . '/tests')
;

return $config;
