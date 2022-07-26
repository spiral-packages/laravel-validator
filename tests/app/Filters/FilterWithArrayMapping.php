<?php

declare(strict_types=1);

namespace Spiral\Validation\Laravel\Tests\App\Filters;

use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Validation\Laravel\FilterDefinition;

final class FilterWithArrayMapping extends Filter implements HasFilterDefinition
{
    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition(
            [
                'username' => 'string|required',
                'email' => 'email|required',
                'image' => 'required|image'
            ],
            [
                'username' => 'username',
                'email' => 'email',
                'image' => 'symfony-file:image'
            ]
        );
    }
}
