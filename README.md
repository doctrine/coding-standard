Doctrine Coding Standard
========================

[![Build Status](https://img.shields.io/travis/doctrine/coding-standard/master.svg?style=flat-square)](http://travis-ci.org/doctrine/coding-standard)
[![Total Downloads](https://img.shields.io/packagist/dt/doctrine/coding-standard.svg?style=flat-square)](https://packagist.org/packages/doctrine/coding-standard)
[![Latest Stable Version](https://img.shields.io/packagist/v/doctrine/coding-standard.svg?style=flat-square)](https://packagist.org/packages/doctrine/coding-standard)


The [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) ruleset to check that
repositories are following the standards defined by the Doctrine team.

Standards
---------

Doctrine Coding Standard is based on [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
and [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md), with some noticeable
exceptions/differences/extensions (:white_check_mark: are the implemented sniffs):

- Keep the nesting of control structures per method as small as possible
- Prefer early exit over nesting conditions or using else
- Abstract exception class names and exception interface names should be suffixed with `Exception`
- :white_check_mark: Abstract classes should not be prefixed with `Abstract`
- :white_check_mark: Interfaces should not be suffixed with `Interface`
- :white_check_mark: Concrete exception class names should not be suffixed with `Exception`
- :white_check_mark: Align equals (`=`) signs in assignments
- :white_check_mark: Add spaces around a concatenation operator `$foo = 'Hello ' . 'World!';`
- :white_check_mark: Add spaces between assignment, control and return statements
- :white_check_mark: Add spaces after a negation operator `if (! $cond)`
- :white_check_mark: Add spaces around a colon in return type declaration `function () : void {}`
- :white_check_mark: Add spaces after a type cast `$foo = (int) '12345';`
- :white_check_mark: Use apostrophes for enclosing strings
- :white_check_mark: Always use strict comparisons
- :white_check_mark: Always add `declare(strict_types=1)` at the beginning of a file
- :white_check_mark: Always add native types where possible
- :white_check_mark: Omit phpDoc for parameters/returns with native types, unless adding description
- :white_check_mark: Don't use `@author`, `@since` and similar annotations that duplicate Git information
- :white_check_mark: Assignment in condition is not allowed
- :white_check_mark: Use parentheses when creating new instances that do not require arguments `$foo = new Foo()`
- :white_check_mark: Use Null Coalesce Operator `$foo = $bar ?? $baz`
- :white_check_mark: Use early return

For full reference of enforcements, go through `lib/Doctrine/ruleset.xml` where each sniff is briefly described.

Installation
------------

You have two possibilities to use the Doctrine Coding Standard with PHP_CodeSniffer in a particular project.

### 1. As a composer dependency of your project

You can install the Doctrine Coding Standard as a composer dependency to your particular project.
Just add the following block to your project's `composer.json` file:

```bash
$ php composer require doctrine/coding-standard:^3.0
```

Then you can use it like:

```bash
$ ./vendor/bin/phpcs --standard=Doctrine /path/to/some/file/to/sniff.php
```

You might also do automatic fixes using `phpcbf`:

```bash
$ ./vendor/bin/phpcbf --standard=Doctrine /path/to/some/file/to/sniff.php
```

### 2. Global installation

You can also install the Doctrine Coding Standard globally:

```bash
$ composer global require doctrine/coding-standard:^3.0
```

Then you can use it like:

```bash
$ phpcs --standard=Doctrine /path/to/some/file/to/sniff.php
```

You might also do automatic fixes using `phpcbf`:

```bash
$ phpcbf --standard=Doctrine /path/to/some/file/to/sniff.php
```

Versioning
----------

This library follows semantic versioning, and additions to the code ruleset
are only performed in major releases.

Testing
-------

If you are contributing to the Doctrine Coding Standard and want to test your contribution, you just
need to execute PHPCS with the tests folder and ensure it matches the expected report:

```bash
$ ./vendor/bin/phpcs tests/input --report=summary --report-file=phpcs.log; diff tests/expected_report.txt phpcs.log
```
