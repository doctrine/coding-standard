Doctrine PHP_CodeSniffer Coding Standard
========================================

[![Build Status](https://secure.travis-ci.org/doctrine/coding-standard.png?branch=master)](http://travis-ci.org/doctrine/coding-standard)
[![Coverage Status](https://coveralls.io/repos/doctrine/coding-standard/badge.png?branch=master)](https://coveralls.io/r/doctrine/coding-standard?branch=master)

The [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) Coding Standard to check against the [Doctrine Coding Standard](https://github.com/deeky666/doctrine-coding-standard/blob/master/Docs/README.md).

Installation
------------

You have two possibilities to use the Doctrine Coding Standard with PHP_CodeSniffer in a particular project.

### 1. As a composer dependency of your project

You can install the Doctrine Coding Standard as a composer dependency to your particular project.
Just add the following block to your project's `composer.json` file:

```bash
$ php composer require doctrine/coding-standard:~0.1@dev
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
$ composer global require doctrine/coding-standard:~0.1@dev
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
