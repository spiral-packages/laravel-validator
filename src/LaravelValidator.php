<?php

declare(strict_types=1);

namespace App\Bootloader\Laravel;

use Illuminate\Contracts\Validation\Factory;
use Illuminate\Contracts\Validation\Validator;
use Spiral\Filters\FilterBag;
use Spiral\Validation\ValidatorInterface;

class LaravelValidator implements ValidatorInterface
{
    private mixed $context = null;
    private Validator $validator;
    private array $data;

    public function __construct(
        private Factory $factory,
        mixed $data,
        private array $rules,
        private array $messages = []
    ) {
        if ($data instanceof FilterBag) {
            $data = $data->entity->toArray();
        }

        $this->data = $data;

        $this->validator = $factory->make($data, $rules, $messages);
    }

    public function withData(mixed $data): ValidatorInterface
    {
        return new static(
            $this->factory,
            $data,
            $this->rules,
            $this->messages
        );
    }

    public function getValue(string $field, mixed $default = null): mixed
    {
        $value = $this->data[$field] ?? $default;

        if (\is_object($value) && \method_exists($value, 'getValue')) {
            return $value->getValue();
        }

        return $value;
    }

    public function hasValue(string $field): bool
    {
        if (\is_array($this->data)) {
            return \array_key_exists($field, $this->data);
        }

        return isset($this->data[$field]);
    }

    public function withContext(mixed $context): ValidatorInterface
    {
        $validator = clone $this;
        $validator->context = $context;

        return $validator;
    }

    public function getContext(): mixed
    {
        return $this->context;
    }

    public function isValid(): bool
    {
        return !$this->validator->fails();
    }

    public function getErrors(): array
    {
        return $this->validator->errors()->toArray();
    }
}
