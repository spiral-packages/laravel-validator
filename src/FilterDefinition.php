<?php

declare(strict_types=1);

namespace Spiral\Validation\Laravel;

use Spiral\Filters\FilterDefinitionInterface;
use Spiral\Filters\ShouldBeValidated;

class FilterDefinition implements FilterDefinitionInterface, ShouldBeValidated
{
    public function __construct(
        private readonly array $rules,
        private readonly array $schema = [],
    ) {
    }

    public function mappingSchema(): array
    {
        return $this->schema;
    }

    public function validationRules(): array
    {
        return $this->rules;
    }
}
