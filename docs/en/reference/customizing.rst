Customizing to your needs
=========================

While Doctrine Coding Standard is based on `PSR-12 <https://www.php-fig.org/psr/psr-12/>`_,
it also consists of a lot of additional advanced and opinionated rules and checks, mostly imported from
the `Slevomat Coding Standard <https://github.com/slevomat/coding-standard>`_.

As different people and projects have different tastes, sooner or later you may find some of them
not compatible with your needs.

Fortunately that's not a problem and it's straightforward to customize the standard to fit your needs,
either by reconfiguring the rules or by disabling/replacing them entirely.

Configurable vs. tailored rules
-------------------------------

Some rules have configurable properties to adjust their behavior (i.e. return type colon spacing),
other are made for one specific purpose (i.e. require or forbid yoda conditions).

To find out whether the specific rule is configurable, take a look at
`CodeSniffer's documentation <https://github.com/squizlabs/PHP_CodeSniffer/wiki/Customisable-Sniff-Properties>`_ and
`Slevomat CS documentation <https://github.com/slevomat/coding-standard#sniffs-included-in-this-standard>`_.

Configuring rule properties
---------------------------

When a sniff is configurable, you can adjust its behavior by setting its properties:

.. code-block:: xml

    <rule ref="Doctrine"/>

    <rule ref="Generic.Files.LineLength">
        <properties>
            <!-- set soft line length limit to 120 characters -->
            <property name="lineLimit" value="120"/>
            <!-- set hard line length limit to 160 characters -->
            <property name="absoluteLineLimit" value="160"/>
        </properties>
    </rule>

Excluding offending rules
-------------------------

It's possible to exclude a specific rule:

.. code-block:: xml
    <rule ref="Doctrine">
        <!-- disable checks for line length -->
        <exclude name="Generic.Files.LineLength"/>
    </rule>

For better granularity, it's possible to also exclude only specific errors (if the sniff reports multiple errors):

.. code-block:: xml

    <rule ref="Doctrine">
        <!-- allow arrays with multiple values on single line -->
        <exclude name="Squiz.Arrays.ArrayDeclaration.SingleLineNotAllowed"/>
    </rule>

It's also possible to exclude either a rule or an error for specific files/directories:

.. code-block:: xml

    <rule ref="Doctrine"/>

    <!-- allow long lines in src/FileWithLongLines.php and in tests/ -->
    <rule ref="Generic.Files.LineLength">
        <exclude-pattern>src/FileWithLongLines.php</exclude-pattern>
        <exclude-pattern>tests/*</exclude-pattern>
    </rule>

Adding new rules
----------------

Adding new rules is simple, all you need to do is add a new ``<rule>`` block:

.. code-block:: xml

    <rule ref="Doctrine"/>

    <!-- add some shiny sniff -->
    <rule ref="Some.Shiny.Syntax"/>

You can directly pick any sniffs from either
`CodeSniffer itself <https://github.com/squizlabs/PHP_CodeSniffer/wiki/>`_
or `Slevomat CS <https://github.com/slevomat/coding-standard#sniffs-included-in-this-standard>`_.
