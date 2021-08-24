# Lumen Discovery
Add package discovery to your lumen application.

## Installation

Require via composer:

`composer require larapkg/lumen-discovery`

Open your base `composer.json` file in your project root and add the following to the end of the file:


    "scripts": {
            "post-autoload-dump": [
                "LaraPkg\LumenDiscover\Events\Dump::post"
            ]
        }


The above will enable the packages' ability to discover and cache your providers and aliases.

Now simply register the packages service provider in your `bootstrap/app.php` file:

    $app->register(\LaraPkg\LumenDiscover\ServiceProvider::class);

With the above complete you can now build packages to your hearts content and not worry about how they register into your lumen app.

To make a package you write compatible with this package, you will need to add the following to your packages composer json:

[Example from barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)

    "extra": {
        "laravel": {
            "providers": [
                "Barryvdh\\Debugbar\\ServiceProvider"
            ],
            "aliases": {
                "Debugbar": "Barryvdh\\Debugbar\\Facade"
            }
        }
    },

With this package you can use `laravel` or `lumen` interchangeably but remember if you want to use your packages with Laravel
you should stick with the `laravel` naming convention.

That's it, now you can pull laravel packages into your lumen app and watch them self register, or you can build you own packages
that will also self-register. Have fun!

The base repository this work is off of is [composer/composer](https://github.com/composer/composer) and it is well worth a read.
