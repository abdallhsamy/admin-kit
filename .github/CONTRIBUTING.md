
Contributing
============

Getting Started

* * * * *

-   [Getting setup](#getting-setup)
-   [Style guide](#style-guide)
-   [Making changes](#making-changes)
-   [Adding or updating translations](#adding-updating-translations)
-   [Additional resources](#additional-resources)

[Getting setup](#getting-setup)
-----------------------------------------------------------------------------------------

-   Fork the [abdallhsamy/admin-kit](https://github.com/abdallhsamy/admin-kit),
-   Clone your fork,
-   Run `composer install`
-   Run `./travis.sh`
-   Make your changes
-   Run `./vendor/bin/phpunit`
-   Send in the pull request if all is green

**Which branch should I make my PR form and send it to?**

-   Current default branch (`0.1`) if you're sending something for version 1.0,
-   Next major release: `main` branch.

[Style guide](#style-guide)
-------------------------------------------------------------------------------------

Please note Admin-Kit follows **[PSR-1](http://www.php-fig.org/psr/psr-1/)** and **[PSR-2](http://www.php-fig.org/psr/psr-2/)**. Please make sure your code follows those standards.

You can use a great tool : **[PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)** to make sure everything is following the correct coding style.

``` {.language-bash}
$ # in your Platform root directory
$ php-cs-fixer fix --verbose
```

To avoid having to type this every time, I have this command aliased to `pcf`, like so:

``` {.language-bash}
pcf="php-cs-fixer fix --verbose"
```

Now I can type `pcf` in the root directory of the module, and it'll just work, giving that there's a `.php_cs` file.

[Making changes](#making-changes)
-------------------------------------------------------------------------------------------

Once you have your copy of Admin-Kit installed and configured for contributing purposes, you're ready to make changes.

Admin-Kit follows a workflow similar to **[Git Flow branching model](https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow/)**.

This means:

-   For a new feature:
    -   On `main` branch,
    -   Create a branch `feature/your-new-feature-name`,
    -   Add you changes,
    -   Make sure the test suite for the module still passes,
    -   [Squash commits](https://ariejan.net/2011/07/05/git-squash-your-latests-commits-into-one/) if necessary to create a nice history,
    -   Send a pull request to the `master` branch of the module/theme your modifying.
-   For a hotfix:
    -   On `main` branch,
    -   Create a branch `hotfix/your-hotfix-name`,
    -   Add a failing test that reproduces the found bug,
    -   Add you changes by making the test pass,
    -   [Squash commits](https://ariejan.net/2011/07/05/git-squash-your-latests-commits-into-one/) if necessary to create a nice history,
    -   Send a pull request to the `master` branch of the module/theme your modifying.

[Adding or updating translations](#adding-updating-translations)
--------------------------------------------------------------------------------------------------------------------------

Adding new translations or updating existing translations to core modules is very easy in Admin-Kit. All translations are centralised in the [Translation](https://github.com/Admin-Kit/Translation) module.

All you need to do is fork that module, and add and/or update existing translations.

The translations are located in the `Resources/lang` folder, each module has its own subfolder, with under that the different locales.

If you want to add a new language, duplicate the `en` folder of each module and renaming it to your desired locale. The English translations will usually the more complete ones, that's why it's best to use those as a starting point.

-------------------------------------------------------------------------------------------------------

-   [General GitHub documentation](http://help.github.com/)
-   [GitHub pull request documentation](http://help.github.com/send-pull-requests/)

© 2021 All Rights Reserved. [built with Laravel](https://laravel.com/) 
-   [twitter](https://twitter.com/abdallhsamy3)
-   [linkedin](https://www.linkedin.com/in/abdallah-samy/)

