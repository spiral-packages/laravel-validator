<?php

declare(strict_types=1);

namespace Spiral\Validation\Laravel\Tests\Functional\Bootloader;

use Spiral\Validation\Laravel\Tests\Functional\TestCase;
use Spiral\Validation\Laravel\Bootloader\ValidatorBootloader;
use Spiral\Validation\Laravel\FilterDefinition;
use Spiral\Validation\Laravel\LaravelValidation;
use Spiral\Validation\ValidationInterface;
use Spiral\Validation\ValidationProviderInterface;

final class ValidatorBootloaderTest extends TestCase
{
    public function testBootloaderRegistered(): void
    {
        $this->assertBootloaderRegistered(ValidatorBootloader::class);
    }

    public function testValidationRegistered(): void
    {
        $provider = $this->getContainer()->get(ValidationProviderInterface::class);

        $this->assertInstanceOf(LaravelValidation::class, $provider->getValidation(FilterDefinition::class));
        $this->assertContainerBoundAsSingleton(ValidationInterface::class, LaravelValidation::class);
    }
}
