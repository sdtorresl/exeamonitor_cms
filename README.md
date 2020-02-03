# Exea Monitor CMS System

A custom CMS for Exea Monitor.

## Prerequisites

A complete CakePHP environment is required for this proyect.

In this [repository](https://github.com/sdtorresl/vagrant-cakephp/) you can deploy a clean environment with all dependencies ready for deploy CakePHP applications.

## Installation

with [composer](https://getcomposer.org/doc/00-intro.md) execute the installation of all dependencies:

```bash
composer install
```

## Configuration

### Initial configuration

Create the `config/app_local.php` file and setup the `'Datasources'` and any other configuration relevant for your application.

Template configuration is in `config/app_local.example.php`.

### Migrations

This proyect uses migrations plugin in order to setup your database with required data. Just execute in your terminal:

```bash
bin/cake migrations migrate
```

#### Seed

Seed the application by following the next steps:

```bash
bin/cake migrations seed -s CitiesSeed
bin/cake migrations seed -s CountriesSeed
```

After that, the database should be ready for your application.

## Versioning

We use [SemVer](https://semver.org/) for versioning. For the versions available, see the tags on this repository.

## Authors

[Sergio Torres](sdtorresl@innovaciones.co)

## License

This project is licensed under the MIT License - see the LICENSE.md file for details

## Support

Have issues? Write to our [support mail](mailto:soporte@innovaciones.co)