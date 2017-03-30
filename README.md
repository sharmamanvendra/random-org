random-org-php
==============

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Random.org JSON-RPC Client implementation for PHP

## Technical details:  
https://api.random.org/json-rpc/1/<br>

## Install

Via Composer

```
$ composer require odan/random-org
```

## Usage

```php
$random = new \Odan\Random\RandomOrgClient();

// Get a API key: https://api.random.org/api-keys
$random->setApiKey('');

// Generate 5 true random integers between 1-100
$integers = $random->generateIntegers(5, 1, 100);
var_dump($integers);

```

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/odan/random-org.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/odan/random-org/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/odan/random-org.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/odan/random-org.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/odan/random-org.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/odan/random-org
[link-travis]: https://travis-ci.org/odan/random-org
[link-scrutinizer]: https://scrutinizer-ci.com/g/odan/random-org/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/odan/random-org
[link-downloads]: https://packagist.org/packages/odan/random-org
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors
