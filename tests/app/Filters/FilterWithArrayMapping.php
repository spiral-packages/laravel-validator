<?php

declare(strict_types=1);

namespace Spiral\Validation\Laravel\Tests\App\Filters;

use Spiral\Filters\Filter;
use Spiral\Filters\FilterDefinitionInterface;
use Spiral\Filters\HasFilterDefinition;
use Spiral\Validation\Laravel\FilterDefinition;

final class FilterWithArrayMapping extends Filter implements HasFilterDefinition
{
    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition(
            [
                'username' => 'string|required',
                'email' => 'email|required'
            ],
            [
                'username' => 'username',
                'email' => 'email'
            ]
        );
    }
}
