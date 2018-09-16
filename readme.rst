Extbase the good parts
======================

Most of the times Extbase is not the best choice.

Why?

Because nowadays we have:

* Form Framework

* FLUIDTEMPLATE / Standalone Fluid

* DataProcessors

But if you need Extbase, it offers some good parts, which will be explained below
with working unit tests.

.. contents:: :local:

Start
-----

Execute the following::

   git clone https://github.com/DanielSiepmann/extbase-the-good-parts.git
   cd extbase-the-good-parts

Clean everything::

   rm -rf composer.lock vendor web Results

Installation development dependencies using composer::

   composer install

Links:

* https://docs.typo3.org/typo3cms/ExtbaseFluidBook/

* https://docs.typo3.org/typo3cms/ExtbaseGuide/

Dependency Injection
--------------------

* Method injection

* Annotation

* Constructor

See:

* https://daniel-siepmann.de/Posts/2017/2017-08-17-typo3-injection.html

* https://daniel-siepmann.de/Posts/Migrated/2015-10-20-extbase-inject-settings.html

Property Mapping
----------------

See :file:`web/typo3/sysext/extbase/ext_localconf.php`,
https://docs.typo3.org/typo3cms/ExtbaseFluidBook/10-Outlook/4-Property-mapping.html

Validation
----------

Command Controllers
-------------------

TypoScript Configuration
------------------------

See https://docs.typo3.org/typo3cms/ExtbaseFluidBook/b-ExtbaseReference/Index.html#typoscript-configuration

Settings array
--------------


ObjectAccess from Fluid
-----------------------

See

* :file:`web/typo3/sysext/fluid/Classes/Core/Variables/CmsVariableProvider.php`

* :file:`web/typo3/sysext/extbase/Classes/Reflection/ObjectAccess.php`

Configuration Mapping DB
------------------------

See https://docs.typo3.org/typo3cms/ExtbaseFluidBook/b-ExtbaseReference/Index.html#persistence
