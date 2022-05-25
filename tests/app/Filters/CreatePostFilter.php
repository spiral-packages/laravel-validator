<?php

declare(strict_types=1);

namespace Spiral\Validation\Laravel\Tests\App\Filters;

use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Filter;
use Spiral\Filters\FilterDefinitionInterface;
use Spiral\Filters\HasFilterDefinition;
use Spiral\Validation\Laravel\FilterDefinition;

final class CreatePostFilter extends Filter implements HasFilterDefinition
{
    #[Post]
    public string $title;

    #[Post]
    public string $slug;

    #[Post]
    public int $sort;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'title' => 'string|required|min:5',
            'slug' => 'string|required|min:5',
            'sort' => 'integer|required|min:0'
        ]);
    }
}
