<?php

namespace Sankokai\UseCase\Tests\Feature;

use Sankokai\Usecase\Tests\TestCase;

class MakeUseCaseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_launch_usecase_command()
    {
        $useCaseName = 'JohnDoe';

        $this->artisan('make:usecase', ['name' => $useCaseName])
            ->expectsOutput('Usecase created successfuly.')
            ->assertSuccessful();

        $this->assertFileExists(
            __DIR__ . '/../../domain/' . $useCaseName . '/' . $useCaseName . '.php'
        );
        // $this->artisan('make:usecase')->assertSuccessful();
    }
}
