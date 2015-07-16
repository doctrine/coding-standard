Doctrine PHP_CodeSniffer Coding Standard
========================================

[![Build Status](https://secure.travis-ci.org/doctrine/coding-standard.png?branch=master)](http://travis-ci.org/doctrine/coding-standard)
[![Coverage Status](https://coveralls.io/repos/doctrine/coding-standard/badge.png?branch=master)](https://coveralls.io/r/doctrine/coding-standard?branch=master)

The [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) Coding Standard to check against the [Doctrine Coding Standard](https://github.com/deeky666/doctrine-coding-standard/blob/master/Docs/README.md).

Installation
------------

You have three possibilities to use the Doctrine Coding Standard with PHP_CodeSniffer in a particular project.

### 1. Standalone installation

You can install the Doctrine Coding Standard as a plugin into your global system PHP_CodeSniffer installation:

```bash
$ cd /path/to/phpcs/CodeSniffer/Standards
$ php composer create-project doctrine/coding-standard Doctrine ~0.1@dev
```

Then you can use it like
(assuming that you have the `phpcs` binary in your search path):

```bash
$ phpcs --standard=Doctrine /path/to/some/file/to/sniff.php
```

Or even set it as default standard
(assuming that you have the `phpcs` binary in your search path):

```bash
$ phpcs --config-set default_standard Doctrine
```

And just sniff a particular file with
(assuming that you have the `phpcs` binary in your search path):

```bash
$ phpcs /path/to/some/file/to/sniff.php
```

### 2. Global installation

You also can install the Doctrine Coding Standard globally:

```bash
$ php composer global require doctrine/coding-standard:~0.1@dev
```

Then you can use it like:

```bash
$ phpcs --standard=~/.composer/vendor/doctrine/coding-standard/Doctrine /path/to/some/file/to/sniff.php
```

Or even set it as default standard:

```bash
$ phpcs --config-set default_standard ~/.composer/vendor/doctrine/coding-standard/Doctrine
```

And just sniff a particular file with:

```bash
$ phpcs /path/to/some/file/to/sniff.php
```

### 3. Custom installation

You can install the Doctrine Coding Standard anywhere you want:

```bash
$ php composer create-project doctrine/coding-standard /path/to/coding-standard/Doctrine ~0.1@dev
```

Then you can use it like:

```bash
$ ./vendor/bin/phpcs --standard=. /path/to/some/file/to/sniff.php
```

### 4. As a composer dependency of your project

You can install the Doctrine Coding Standard as a composer dependency to your particular project.
Just add the following block to your project's `composer.json` file:

```bash
$ php composer require doctrine/coding-standard:~0.1@dev
```

Then you can use it like:

```bash
$ ./vendor/bin/phpcs --standard=vendor/doctrine/coding-standard/Doctrine /path/to/some/file/to/sniff.php
```

Testing
-------

If you are contributing to the Doctrine Coding Standard and want to test your contribution, you have to
make sure all dependencies are correctly installed:

```bash
$ php composer install --prefer-source
```

The option `--prefer-source` is particularly necessary to ensure the test suite from PHP_CodeSniffer is
installed. Otherwise the test suite for the Doctrine Coding Standard won't work!

Run the test suite with:

```bash
$ ./vendor/bin/phpunit
```
