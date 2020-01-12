# Exea Monitor CMS System

A custom CMS for Exea Monitor.
Author: @sdtorresl

## Prerequisites

A complete CakePHP environment is required for this proyect.

In this [repository](https://github.com/sdtorresl/vagrant-cakephp/) you can deploy a clean environment with all dependencies ready for deploy CakePHP applications.

## Installation

1. with [composer](https://getcomposer.org/doc/00-intro.md) execute the installation of all dependencies:

   ```bash
    composer install
    ```

2. Install dependencies:

    If Composer is installed globally, run:

   ```bash
    composer install
    ```

## Configuration

### Initial configuration

Create the `config/app.php` file and setup the `'Datasources'` and any other configuration relevant for your application.

Template configuration is in `config/app.default.php`.

### Migrations

This proyect uses migrations plugin in order to setup your database with required data. Just execute in your terminal:

```bash
bin/cake migrations migrate
```

After that, the database should be ready for your application.


