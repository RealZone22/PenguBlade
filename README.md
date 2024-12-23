# PenguBlade

[![Latest Version on Packagist](https://img.shields.io/packagist/v/realzone22/pengublade.svg?style=flat-square)](https://packagist.org/packages/realzone22/pengublade)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/realzone22/pengublade/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/realzone22/pengublade/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/realzone22/pengublade/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/realzone22/pengublade/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/realzone22/pengublade.svg?style=flat-square)](https://packagist.org/packages/realzone22/pengublade)

PenguBlade is a collection of Blade components designed to enhance your Laravel applications with beautiful and
functional UI elements. Built with Livewire and Tailwind CSS, PenguBlade provides a seamless development experience for
creating interactive and dynamic user interfaces.

## Installation

You can install the package via Composer:

```bash
composer require realzone22/pengublade
```

## Usage

To use a PenguBlade component, you first need to publish it:

```bash
# For all components
php artisan vendor:publish --tag=pengublade-components

# For a specific component (e.g. Button)
php artisan vendor:publish --tag=pengublade-components-button
```

This will publish the Blade component to your `resources/views/components` directory. You can then include the component
in your Blade views like so:

```blade
<x-button>
    Click me
</x-button>
```

More detailed usage instructions for each component can be found in
the [documentation](https://github.com/RealZone22/PenguBlade).

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Lenny P. | RealZone22](https://github.com/RealZone22)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
