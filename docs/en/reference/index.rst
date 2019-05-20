Introduction
============

The Doctrine Coding Standard is a set of rules for `PHP_CodeSniffer <https://github.com/squizlabs/PHP_CodeSniffer>`_
and applies to all Doctrine projects. It is based on `PSR-1 <https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md>`_
and `PSR-2 <https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md>`_, with some noticeable
exceptions/differences/extensions.

- Keep the nesting of control structures per method as small as possible
- Abstract exception class names and exception interface names should be suffixed with ``Exception``
- Abstract classes should not be prefixed or suffixed with ``Abstract``
- Interfaces should not be prefixed or suffixed with ``Interface``
- Concrete exception class names should not be prefixed or suffixed with ``Exception``
- Align equals (``=``) signs in assignments
- Add spaces around a concatenation operator ``$foo = 'Hello ' . 'World!';``
- Add spaces between assignment, control and return statements
- Add spaces after a negation operator ``if (! $cond)``
- Add spaces around a colon in return type declaration ``function () : void {}``
- Add spaces after a type cast ``$foo = (int) '12345';``
- Use apostrophes for enclosing strings
- Always use strict comparisons
- Always add ``declare(strict_types=1)`` at the beginning of a file
- Always add native types where possible
- Omit phpDoc for parameters/returns with native types, unless adding description
- Don't use ``@author``, ``@since`` and similar annotations that duplicate Git information
- Assignment in condition is not allowed
- Use parentheses when creating new instances that do not require arguments ``$foo = new Foo()``
- Use Null Coalesce Operator ``$foo = $bar ?? $baz``
- Prefer early exit over nesting conditions or using else

For full reference of enforcements, go through ``lib/Doctrine/ruleset.xml`` where each sniff is briefly described.

Installation
============

You have two possibilities to use the Doctrine Coding Standard with PHP_CodeSniffer in a particular project.

Composer Project Dependency
---------------------------

You can install the Doctrine Coding Standard as a composer dependency to your particular project.
Just run the following command to add the Doctrine Coding Standard to your project:

.. code-block:: bash

    $ php composer require --dev doctrine/coding-standard

Then you can use it like:

.. code-block:: bash

    $ vendor/bin/phpcs --standard=Doctrine /path/to/some/file/to/sniff.php

You might also do automatic fixes using ``phpcbf``:

.. code-block:: bash

    $ vendor/bin/phpcbf --standard=Doctrine /path/to/some/file/to/sniff.php

Composer Global Installation
----------------------------

You can also install the Doctrine Coding Standard globally:

.. code-block:: bash

    $ composer global require doctrine/coding-standard

Then you can use it like:

.. code-block:: bash

    $ phpcs --standard=Doctrine /path/to/some/file/to/sniff.php

You might also do automatic fixes using ``phpcbf``:

.. code-block:: bash

    $ phpcbf --standard=Doctrine /path/to/some/file/to/sniff.php

Project-level ruleset
=====================

To enable Doctrine Coding Standard for your project, create a ``phpcs.xml.dist`` file with the following content:

.. code-block:: xml

    <?xml version="1.0"?>
    <ruleset>
        <arg name="basepath" value="."/>
        <arg name="extensions" value="php"/>
        <arg name="parallel" value="80"/>
        <arg name="cache" value=".phpcs-cache"/>
        <arg name="colors"/>

        <!-- Ignore warnings, show progress of the run and show sniff names -->
        <arg value="nps"/>

        <!-- Directories to be checked -->
        <file>lib</file>
        <file>tests</file>

        <!-- Include full Doctrine Coding Standard -->
        <rule ref="Doctrine"/>
    </ruleset>

This will enable verbatim Doctrine Coding Standard with all rules included with their defaults.
From now on you can just run ``vendor/bin/phpcs`` and ``vendor/bin/phpcbf`` without any arguments.

Don't forget to add ``.phpcs-cache`` and ``phpcs.xml`` (without ``.dist`` suffix) to your ``.gitignore``.
The first ignored file is a cache used by PHP CodeSniffer to speed things up,
the second one allows any developer to adjust configuration locally without touching the versioned file.

For further reading about the CodeSniffer configuration, please refer to
`the configuration format overview <https://github.com/squizlabs/PHP_CodeSniffer/wiki/Annotated-Ruleset>`_
and `the list of configuration options <https://github.com/squizlabs/PHP_CodeSniffer/wiki/Configuration-Options>`_

To learn about customizing the rules, please refer to the :ref:`customizing` chapter.

Versioning
==========

This library follows semantic versioning, and additions to the code ruleset
are only performed in major releases.

Testing
=======

If you are contributing to the Doctrine Coding Standard and want to test your contribution, you just
need to execute PHP_CodeSniffer with the tests folder and ensure it matches the expected report:

.. code-block:: bash

    $ ./vendor/bin/phpcs tests/input --report=summary --report-file=phpcs.log; diff tests/expected_report.txt phpcs.log

If you have implemented custom sniff also run PHPStan and PHPUnit.
The PHPUnit version to be used is the one installed as a dev- dependency
via composer (same rules are for PHPStan):

.. code-block:: console

   $ ./vendor/bin/phpunit
   $ ./vendor/bin/phpstan analyse

Accepted coverage for new contributions is 80%. There must not be any errors shown by PHPStan.
Any contribution not satisfying this requirement won’t be merged.