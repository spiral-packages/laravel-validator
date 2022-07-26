<?php

declare(strict_types=1);

namespace Spiral\Validation\Laravel\Tests\App\Filters;

use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Validation\Laravel\FilterDefinition;

final class SimpleFilter extends Filter implements HasFilterDefinition
{
    #[Post]
    public string $username;

    #[Post]
    public string $email;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'username' => 'string|required',
            'email' => 'email|required'
        ]);
    }
}
