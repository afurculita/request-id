# Request ID 

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This library includes:
    
 1. A **PSR7 middleware** that provides framework-agnostic possibility to generate and add to request/response's header a request ID.
 1. A **Symfony Bundle** that provides possibility to generate and add a request id to request/response's header in a Symfony application.
 1. A **Monolog processor** that adds the request id to each log message.
 1. A **Twig Extension** that provides a function that returns the request id.
  
[![Emblem](docs/emblem.jpg)](https://github.com/arkitekto/request-id)

## Install

Via Composer

```bash
$ composer require arkitekto/request-id
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email alex@furculita.net instead of using the issue tracker.

## Credits

- [Alexandru Furculita][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/arkitekto/request-id.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/arkitekto/request-id/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/arkitekto/request-id.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/arkitekto/request-id.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/arkitekto/request-id.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/arkitekto/request-id
[link-travis]: https://travis-ci.org/arkitekto/request-id
[link-scrutinizer]: https://scrutinizer-ci.com/g/arkitekto/request-id/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/arkitekto/request-id
[link-downloads]: https://packagist.org/packages/arkitekto/request-id
[link-author]: https://github.com/afurculita
[link-contributors]: ../../contributors
