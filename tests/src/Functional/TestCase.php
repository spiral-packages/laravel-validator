<?php

declare(strict_types=1);

namespace Spiral\Validation\Laravel\Tests\Functional;

use Spiral\Attributes\Bootloader\AttributesBootloader;
use Spiral\Boot\Environment;
use Spiral\Boot\EnvironmentInterface;
use Spiral\Bootloader\Security\FiltersBootloader;
use Spiral\Core\Container;
use Spiral\Http\Bootloader\DiactorosBootloader;
use Spiral\Testing\TestableKernelInterface;
use Spiral\Validation\Bootloader\ValidationBootloader;
use Spiral\Validation\Laravel\Bootloader\ValidatorBootloader;

abstract class TestCase extends \Spiral\Testing\TestCase
{
    public function rootDirectory(): string
    {
        return \dirname(__DIR__ . '/../../app');
    }

    public function defineBootloaders(): array
    {
        return [
            AttributesBootloader::class,
            DiactorosBootloader::class,
            FiltersBootloader::class,
            ValidationBootloader::class,
            ValidatorBootloader::class,
        ];
    }

    public function createAppInstance(Container $container = new Container()): TestableKernelInterface
    {
        $container->bindSingleton(EnvironmentInterface::class, new Environment());

        return parent::createAppInstance($container);
    }

    protected function tearDown(): void
    {
        $this->cleanUpRuntimeDirectory();
    }
}
