# Activity Log for Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marvinosswald/filament-activity-log.svg?style=flat-square)](https://packagist.org/packages/marvinosswald/filament-activity-log)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/marvinosswald/filament-activity-log/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/marvinosswald/filament-activity-log/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/marvinosswald/filament-activity-log/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/marvinosswald/filament-activity-log/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/marvinosswald/filament-activity-log.svg?style=flat-square)](https://packagist.org/packages/marvinosswald/filament-activity-log)



This is a Infolist Entry which displays log line from https://github.com/spatie/laravel-activitylog.

## Installation

You can install the package via composer:

```bash
composer require marvinosswald/filament-activity-log
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-activity-log-views"
```

## Usage

```php
ActivityLogEntry::make()
->with('shippingAddress.activities')
->formatDescriptionUsing(fn(Activity $activity) => $activity->description)
->formatSubjectUsing(function (Activity $activity) {
    if ($activity->subject_type == OrderAddress::class) {
        return __("models.{$activity->subject_type}", ['type' => $activity->subject->type]);
    }
    return __("models.{$activity->subject_type}");
})
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Marvin Osswald](https://github.com/marvinosswald)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
