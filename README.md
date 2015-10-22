# Laravel Uuid Model

[![Latest Version](https://img.shields.io/github/release/stevenmaguire/laravel-uuid-model.svg?style=flat-square)](https://github.com/stevenmaguire/laravel-uuid-model/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/stevenmaguire/laravel-uuid-model/master.svg?style=flat-square)](https://travis-ci.org/stevenmaguire/laravel-uuid-model)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/stevenmaguire/laravel-uuid-model.svg?style=flat-square)](https://scrutinizer-ci.com/g/stevenmaguire/laravel-uuid-model/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/stevenmaguire/laravel-uuid-model.svg?style=flat-square)](https://scrutinizer-ci.com/g/stevenmaguire/laravel-uuid-model)
[![Total Downloads](https://img.shields.io/packagist/dt/stevenmaguire/laravel-uuid-model.svg?style=flat-square)](https://packagist.org/packages/stevenmaguire/laravel-uuid-model)

Create non-incrementing models whose primary key is a UUID.

## Install

Via Composer

``` bash
$ composer require stevenmaguire/laravel-uuid-model
```

## Usage

### Extend the `UuidModel`

```php
class User extends Stevenmaguire\Laravel\UuidModel
{
    //
}
```

By default any model that extends the `UuidModel` will automatically assign a random UUID value to the `primaryKey` while `creating`.

To include custom "UUID attributes", each model that extends the `UuidModel` can declare those attributes as an array value for the `uuidAttributes` property.

```php
class User extends Stevenmaguire\Laravel\UuidModel
{
    /**
     * Auto-assigned uuid model attributes.
     *
     * @var array
     */
    public $uuidAttributes = ['foo', 'bar'];
}
```

This will result in the model's primary key, `id`, `foo`, and `bar` all being automatically assigned a random UUID value.

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email stevenmaguire@gmail.com instead of using the issue tracker.

## Credits

- [Steven Maguire](https://github.com/stevenmaguire)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
