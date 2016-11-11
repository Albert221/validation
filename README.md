# Basic validator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Installation

Via Composer

```bash
composer require albert221/validation ^1.0
```

## Usage

```php
use Albert221\Validation\Validator;
use Albert221\Validation\Rule;

/** @var Psr\Http\Message\ServerRequestInterface $request **/

$validator = new Validator();

// Add field named 'phone' to validator
$validator->addField('phone', $request->getParsedBody()['phone']);
// Add some validation rules to this field
$validator->addRule('phone', new Rule\Required())
    ->setMessage('Sorry, but phone is required to proceed.');
$validator->addRule('phone', new Rule\Regex('/^(?:[0+]48)?(\d{9})$/'))
    ->setMessage('Sorry, but your phone is incorrect.');

// (...)

// You have to call validate before retrieving errors, this way:
// $validator->validate()
// or this way:
if ($validator->validate()->getErrorsCount() > 0) {
    $errors = $validator->getErrors();
    
    // Do stuff with errors, probably flash it and redirect form or something
}

// Validation passed!
```

## Availible rules

- `Required()`
- `Email()`
- `Url()`
- `Regex()`
- `Equal(mixed $object)`
- `MinLength(int $min)`
- `MaxLength(int $max)`
- `Length(int $length)`

[ico-version]: https://img.shields.io/packagist/v/albert221/validation.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Albert221/validation/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/albert221/validation.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/albert221/validation.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/albert221/validation.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/albert221/validation
[link-travis]: https://travis-ci.org/Albert221/validation
[link-scrutinizer]: https://scrutinizer-ci.com/g/albert221/validation/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/albert221/validation
[link-downloads]: https://packagist.org/packages/albert221/validation