Doctrine Coding Standard
========================

[![Build Status](https://img.shields.io/travis/doctrine/coding-standard/master.svg?style=flat-square)](http://travis-ci.org/doctrine/coding-standard)
[![Total Downloads](https://img.shields.io/packagist/dt/doctrine/coding-standard.svg?style=flat-square)](https://packagist.org/packages/doctrine/coding-standard)
[![Latest Stable Version](https://img.shields.io/packagist/v/doctrine/coding-standard.svg?style=flat-square)](https://packagist.org/packages/doctrine/coding-standard)


The [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) ruleset to check that
repositories are following the standards defined by the Doctrine team.

Standards
---------

@TODO

Installation
------------

You can install the Doctrine Coding Standard as a composer dependency to your particular project.
Just add the following block to your project's `composer.json` file:

```bash
$ composer require doctrine/coding-standard
```

Then add the `.php_cs` to your project:

```php
<?php

$config = new Doctrine\CodingStandard\Config();
$config->getFinder()
    ->in(__DIR__ . '/lib')
    ->in(__DIR__ . '/tests')
;

return $config;
```

And finally run PHP-CS-Fixer:

```bash
$ vendor/bin/php-cs-fixer fix -v
```

Testing
-------

If you are contributing to the Doctrine Coding Standard and want to test your contribution, you just
need to execute PHP-CS-Fixer:

```bash
$ vendor/bin/php-cs-fixer fix -v --dry-run --diff
```
