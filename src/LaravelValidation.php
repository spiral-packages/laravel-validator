<?php

declare(strict_types=1);

namespace Spiral\Validation\Laravel;

use Illuminate\Contracts\Validation\Factory;
use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterBag;
use Spiral\Validation\ValidationInterface;
use Spiral\Validation\ValidatorInterface;

class LaravelValidation implements ValidationInterface
{
    public function __construct(
        private readonly Factory $factory
    ) {
    }

    public function validate(mixed $data, array $rules, mixed $context = null): ValidatorInterface
    {
        if ($data instanceof FilterBag) {
            $data = $data->entity->toArray();
        } elseif ($data instanceof Filter) {
            $data = $data->getData();
        }

        $validator = new LaravelValidator(
            $this->factory, $data, $rules
        );

        return $validator->withContext($context);
    }
}
