<p align="center"><img src="https://i.imgur.com/nsWZks5.png" alt="Logo Laravel XHProf"></p>

<p align="center">
<a href="https://packagist.org/packages/laracraft-tech/laravel-xhprof"><img src="https://img.shields.io/packagist/dt/laracraft-tech/laravel-xhprof" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laracraft-tech/laravel-xhprof"><img src="https://img.shields.io/packagist/v/laracraft-tech/laravel-xhprof" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laracraft-tech/laravel-xhprof"><img src="https://img.shields.io/packagist/l/laracraft-tech/laravel-xhprof" alt="License"></a>
<a href="https://github.com/laracraft-tech/laravel-xhprof/actions/workflows/check_imports.yml"><img src="https://github.com/laracraft-tech/laravel-xhprof/actions/workflows/check_imports.yml/badge.svg?branch=1.x" alt="License"></a>
</p>

<!--
#Laravel XHProf

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
-->

## Introduction

Laravel XHProf provides you with a simple setup to profile your Laravel application
with the well-known XHProf PHP extension originally developed by Facebook. 
It also leads you through the steps to install XHProf UI, a UI to visualize, save, and analyze the results
of the profiling.

<p align="center">
<img src="https://i.imgur.com/tNBhiPg.png">
</p>

## Installation

First, you'll need to install the PHP extension.
It's highly recommended to use ondrejs ppa.
It's well maintained and provides quite all PHP versions.

### Normal environment

If you have a normal PHP environment, just install the XHProf extension:

``` bash
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php php-xhprof Graphviz
# You can now check if the extension was successfully installed
php -i | grep xhprof
# maybe restart your webserver or php-fpm...
```

Note: we need Graphviz to generate callgraphs.

### Laravel Sail environment

If you are using laravel sail, here's a setup for you:

``` bash
sail up -d
sail artisan sail:publish
# in docker-compose.yml check wich php version is used under build->context (eg. ./docker/8.1)
# If you know the php-version you can type:
nano docker/<php-version>/Dockerfile
# find the block where all php extensions are installed and add "php<php-version>-xhprof graphviz \"
# Now you need to rebuild the sail
sail down ; sail build --no-cache ; sail up -d # this may take a while...
# You can now check if the extension was successfully installed
sail php -i | grep xhprof
```

Note: The provided Laravel Sail Dockerfile already uses ondrejs ppa.

### Install the Package

``` bash
composer require laracraft-tech/laravel-xhprof --dev
php artisan vendor:publish --provider="LaracraftTech\LaravelXhprof\XHProfServiceProvider" --tag="config"
```

### Install the UI

We are using the recommended fork by php.net from "preinheimer":
https://www.php.net/manual/en/xhprof.requirements.php

``` bash
mkdir public/vendor ; git clone git@github.com:preinheimer/xhprof.git ./public/vendor/xhprof
# If you haven't already, I recommend adding public/vendor to your .gitignore
echo "/public/vendor" >> .gitignore
```

### Database

Since the database table name,
which the UI package is using behind to store and read data from the database,
is hard coded to ``details`` and you already may have a table named like that,
you may need to take some additional steps. If not, here at first the simple way:

<br/>

#### In case you DON'T already HAVE your own ``details`` table in your database:

``` bash
php artisan vendor:publish --provider="LaracraftTech\LaravelXhprof\XHProfServiceProvider" --tag="migrations"
php artisan migrate
```
<br/>

#### In case you already HAVE an own ``details`` table in your database:

I recommend just using a different database. 

``` mysql
CREATE DATABASE xhprof;
USE xhprof;
CREATE TABLE IF NOT EXISTS `details` (
  `id` char(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_url` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `server name` char(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perfdata` longblob,
  `type` tinyint DEFAULT NULL,
  `cookie` longblob,
  `post` longblob,
  `get` blob,
  `pmu` int DEFAULT NULL,
  `wt` int DEFAULT NULL,
  `cpu` int DEFAULT NULL,
  `server_id` char(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aggregateCalls_include` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `details_url_index` (`url`),
  KEY `details_c_url_index` (`c_url`),
  KEY `details_cpu_index` (`cpu`),
  KEY `details_wt_index` (`wt`),
  KEY `details_pmu_index` (`pmu`),
  KEY `details_timestamp_index` (`timestamp`),
  KEY `details_server name_timestamp_index` (`server name`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

Note: you also need to create a user who has privileges on that new database!

### Config

Now let's configure some settings!

``` bash
cp public/vendor/xhprof/xhprof_lib/config.sample.php public/vendor/xhprof/xhprof_lib/config.php
# 1. Change the DB credentials to your needs
# 2. enable dot_binary section
# 3. If you're local, set $controlIPs to false
nano public/vendor/xhprof/xhprof_lib/config.php
```

## Usage

Just set ``XHPROF_ENABLED=true`` in your .env file and
now every request you make to your application gets profiled. \
Visit ``<your-host>/vendor/xhprof/xhprof_html/`` to see your profiling results.

Happy analyzing!


<!-- 

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
composer test
```

 -->

## Security

If you discover any security-related issues, please email zacharias.creutznacher@gmail.com instead of using the issue tracker.

## Credits

- [Zacharias Creutznacher][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/laracraft-tech/laravel-xhprof.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/laracraft-tech/laravel-xhprof.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/laracraft-tech/laravel-xhprof/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/laracraft-tech/laravel-xhprof
[link-downloads]: https://packagist.org/packages/laracraft-tech/laravel-xhprof
[link-travis]: https://travis-ci.org/laracraft-tech/laravel-xhprof
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/laracraft-tech
[link-contributors]: ../../contributors
