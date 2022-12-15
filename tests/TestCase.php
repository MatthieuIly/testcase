<?php

namespace Sankokai\Usecase\Tests;

use Sankokai\Usecase\UsecaseServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            UsecaseServiceProvider::class,
        ];
    }

}
