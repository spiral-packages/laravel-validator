<?php

declare(strict_types=1);

namespace Spiral\Validation\Laravel\Config;

use Spiral\Core\InjectableConfig;

final class LaravelConfig extends InjectableConfig
{
    public const CONFIG = 'laravel-validator';
    protected array $config = [];
}
