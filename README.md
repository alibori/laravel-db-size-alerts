# Laravel package to receive alerts about database size limits.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alibori/laravel-db-size-alerts.svg?style=flat-square)](https://packagist.org/packages/alibori/laravel-db-size-alerts)
[![Total Downloads](https://img.shields.io/packagist/dt/alibori/laravel-db-size-alerts.svg?style=flat-square)](https://packagist.org/packages/alibori/laravel-db-size-alerts)
[![run-tests](https://github.com/alibori/laravel-db-size-alerts/actions/workflows/run-tests.yml/badge.svg)](https://github.com/alibori/laravel-db-size-alerts/actions/workflows/run-tests.yml)
[![PHPStan](https://github.com/alibori/laravel-db-size-alerts/actions/workflows/phpstan.yml/badge.svg)](https://github.com/alibori/laravel-db-size-alerts/actions/workflows/phpstan.yml)

This package allows you to receive alerts about database tables size limits.

## Installation

**IMPORTANT:** This package requires mysql database connection.

You can install the package via composer:

```bash
composer require alibori/laravel-db-size-alerts
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="db-size-alerts-config"
```

You can publish the mail views file with:

```bash
php artisan vendor:publish --tag="db-size-alerts-views"
```

## Usage

You can use the following artisan command to check the specified tables size:

```bash
php artisan db-size:check
```

Or, recommended, you can schedule the artisan command to run periodically on your `App\Console\Kernel.php` file:

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command(LaravelDbSizeAlertsCommand::class)->daily();
}
```

In both cases, if the *APP_ENV* is not *local* you will receive an email with the tables that have exceeded the specified size limit.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Axel Libori Roch](https://github.com/alibori)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
