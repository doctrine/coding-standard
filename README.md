Doctrine PHP_CodeSniffer Coding Standard
========================================

[![Build Status](https://img.shields.io/travis/doctrine/coding-standard/master.svg?style=flat-square)](http://travis-ci.org/doctrine/coding-standard)
[![Total Downloads](https://img.shields.io/packagist/dt/doctrine/coding-standard.svg?style=flat-square)](https://packagist.org/packages/doctrine/coding-standard)
[![Latest Stable Version](https://img.shields.io/packagist/v/doctrine/coding-standard.svg?style=flat-square)](https://packagist.org/packages/doctrine/coding-standard)


The [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) ruleset to check that repositories are
following the standards defined by the our team.

Standards
---------

We use [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
and [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) with some
exceptions/differences (:white_check_mark: are the implemented sniffs):

- Keep the nesting of control structures per method as small as possible
- Add spaces between assignment, control and return statements
- Prefer early exit over nesting conditions
- :white_check_mark: Align equals (=) signs
- :white_check_mark: Add spaces around a concatenation operator `$foo = 'Hello ' . 'World!';`
- :white_check_mark: Add spaces around a negation if condition `if ( ! $cond)`
- :white_check_mark: Add spaces around a return type declaration `function () : void {}`
- :white_check_mark: Add spaces after a type cast `$foo = (int) '12345';`

Installation
------------

You have two possibilities to use the Doctrine Coding Standard with PHP_CodeSniffer in a particular project.

### 1. As a composer dependency of your project

You can install the Doctrine Coding Standard as a composer dependency to your particular project.
Just add the following block to your project's `composer.json` file:

```bash
$ php composer require doctrine/coding-standard:~1.0
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
$ composer global require doctrine/coding-standard:~1.0
```

Then you can use it like:

```bash
$ phpcs --standard=Doctrine /path/to/some/file/to/sniff.php
```

You might also do automatic fixes using `phpcbf`:

```bash
$ phpcbf --standard=Doctrine /path/to/some/file/to/sniff.php
```

Testing
-------

If you are contributing to the Doctrine Coding Standard and want to test your contribution, you just
need to execute PHPCS with the tests folder and ensure it matches the expected report:

```bash
$ ./vendor/bin/phpcs tests/input --report=summary --report-file=phpcs.log; diff tests/expected_report.txt phpcs.log
```
