<?php

declare(strict_types=1);

namespace Spiral\Validation\Laravel;

use Illuminate\Contracts\Validation\Factory;
use Spiral\Filters\Filter;
use Spiral\Validation\ValidationInterface;
use Spiral\Validation\ValidatorInterface;

class LaravelValidation implements ValidationInterface
{
    public function __construct(
        private Factory $factory
    ) {
    }

    public function validate(mixed $data, array $rules, mixed $context = null): ValidatorInterface
    {
        if ($data instanceof Filter) {
            $data = $data->getData();
        }

        $validator = new LaravelValidator(
            $this->factory, $data, $rules
        );

        return $validator->withContext($context);
    }
}
