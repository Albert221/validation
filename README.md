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
composer require albert221/validation ^2.0
```

## Usage

```php
use Albert221\Validation\Validator;
use Albert221\Validation\Rule;

// $data = [...];

$verdicts = Validator::build()
    ->addField('username')
        ->addRule(Rule\Required::class)
        ->addRule(Rule\Length::class, ['min' => 4])
        ->addRule(Rule\PdoUnique::class, ['pdo' => $pdo, 'table' => 'users', 'field' => 'username'])
    ->addField('email')
        ->addRule(Rule\Required::class)
        ->addRule(Rule\Email::class)
        ->addRule(Rule\PdoUnique::class, ['pdo' => $pdo, 'table' => 'users', 'field' => 'email'])
    ->addField('password')
        ->addRule(Rule\Required::class)
        ->addRule(Rule\Length::class)
            ->setOption('min', 6) // You can set options that way, too!
        ->addRule(Rule\Complexity::class, ['alpha' => true, 'num' => true, 'special' => true])
            ->setMessage('Your password is too weak!')
    ->addField('confirm_password')
        ->addRule(Rule\SameAs::class, ['field' => 'password']
    ->validate($data);

if ($verdicts->fail()) {
    // Validation failed
}

// Validation passed

# Other methods

$verdicts->pass(); // Is valid?
$verdicts->forField('username'); // Get all verdicts for specified field.
$verdicts->forField('username')->pass(); // Is specified field valid?
$verdicts->toArray(); // Get all verdicts as an array.
```


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
