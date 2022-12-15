<?php

namespace Sankokai\Usecase\Tests;

use Sankokai\Usecase\UsecaseServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->setBasePath(__DIR__ . '/../');
    }

    protected function getPackageProviders($app)
    {
        return [
            UsecaseServiceProvider::class,
        ];
    }

}
