# Laravel validator bridge for Spiral Framework

[![PHP](https://img.shields.io/packagist/php-v/spiral-packages/laravel-validator.svg?style=flat-square)](https://packagist.org/packages/spiral-packages/laravel-validator)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/spiral-packages/laravel-validator.svg?style=flat-square)](https://packagist.org/packages/spiral-packages/laravel-validator)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/spiral-packages/laravel-validator/run-tests?label=tests&style=flat-square)](https://github.com/spiral-packages/laravel-validator/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/spiral-packages/laravel-validator.svg?style=flat-square)](https://packagist.org/packages/spiral-packages/laravel-validator)

## Requirements

Make sure that your server is configured with following PHP version and extensions:

- PHP 8.1+
- Spiral framework 3.0+



## Installation

You can install the package via composer:

```bash
composer require spiral-packages/laravel-validator
```

After package install you need to register bootloader from the package.

```php
protected const LOAD = [
    // ...
    \Spiral\Validation\Laravel\Bootloader\ValidatorBootloader::class,
];
```

> Note: if you are using [`spiral-packages/discoverer`](https://github.com/spiral-packages/discoverer),
> you don't need to register bootloader by yourself.

## Usage

First of all, need to create a filter that will receive incoming data that will be validated by the validator.

### Filter with attributes
Create a filter class and extend it from the base filter class `Spiral\Filters\Filter`, add `Spiral\Filters\HasFilterDefinition` interface.
Implement the `filterDefinition` method, which should return a `Spiral\Validation\Symfony\FilterDefinition` object with 
validation rules.

Example:
```php
<?php

declare(strict_types=1);

namespace App\Filters;

use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Filter;
use Spiral\Filters\FilterDefinitionInterface;
use Spiral\Filters\HasFilterDefinition;
use Spiral\Validation\Laravel\FilterDefinition;
use Spiral\Validation\Laravel\Attribute\Input\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class CreatePostFilter extends Filter implements HasFilterDefinition
{
    #[Post]
    public string $title;

    #[Post]
    public string $slug;

    #[Post]
    public int $sort;

    #[File]
    public UploadedFile $image;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'title' => 'string|required|min:5',
            'slug' => 'string|required|min:5',
            'sort' => 'integer|required',
            'image' => 'required|image'
        ]);
    }
}
```

### Filter with array mapping
If you prefer to configure fields mapping in an array, you can define fields mapping in a `filterDefinition` method.

Example:
```php
<?php

declare(strict_types=1);

namespace App\Filters;

use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Filter;
use Spiral\Filters\FilterDefinitionInterface;
use Spiral\Filters\HasFilterDefinition;
use Spiral\Validation\Laravel\FilterDefinition;

final class CreatePostFilter extends Filter implements HasFilterDefinition
{
    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition(
            [
                'title' => 'string|required|min:5',
                'slug' => 'string|required|min:5',
                'sort' => 'integer|required',
                'image' => 'required|image'
            ],
            [
                'title' => 'title',
                'slug' => 'slug',
                'sort' => 'sort',
                'image' => 'symfony-file:image'
            ]
        );
    }
}
```

### Using a Filter and getting validation errors

Example:
```php
use App\Filters\CreatePostFilter;
use Spiral\Filters\Exception\ValidationException;

try {
    $filter = $this->container->get(CreatePostFilter::class); 
} catch (ValidationException $e) {
    var_dump($e->errors); // Errors processing
}
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

- [butschster](https://github.com/spiral-packages)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
