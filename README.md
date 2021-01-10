<p align="center"><a href="https://pharephp.org/" title="Phare PHP website"><img src="https://user-images.githubusercontent.com/2951704/103174988-f4736780-4866-11eb-8ecb-503d2842ec60.png" alt="Social card of Phare PHP"></a></p>

# Code architecture supervisor for PHP projects

[![Status](https://img.shields.io/github/checks-status/phare/phare/main?label=Status&style=for-the-badge)](https://github.com/phare/phare/actions)
[![Version](https://img.shields.io/packagist/v/phare/phare?label=Version&style=for-the-badge)](https://github.com/phare/phare/tags)
[![Scrutinizer code quality](https://img.shields.io/scrutinizer/quality/g/phare/phare/main?style=for-the-badge)](https://scrutinizer-ci.com/g/phare/phare/)
[![MIT Licensed](https://img.shields.io/github/license/phare/phare?style=for-the-badge&color=brightgreen)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/phare/phare.svg?style=for-the-badge)](https://packagist.org/packages/phare/phare)

Use Phare to supervise code architecture for one or multiple projects, during local development or continuous integration, without having to think about it.

## Installation

Using composer:

```bash
composer require --dev phare/phare
```

or for a global install

```bash
composer global require phare/phare
```

You can create a configuration file for your project with the help of Phare's installation wizard:

```bash
./vendor/bin/phare install
```

## Usage

```bash
./vendor/bin/phare
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Code of Conduct

This project adheres to a [Code of Conduct](https://github.com/phare/phare/blob/master/CODE_OF_CONDUCT.md). By participating in this project and its community, you are expected to uphold this code.

## Contributing

Any contributions are welcome. Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security-related issues, please email [nicolas@bvs.email](mailto:nicolas@bvs.email) instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
