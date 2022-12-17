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

    /** @test */
    public function it_create_multiples_files()
    {
        $useCaseName = 'JohnDoe';

        $this->artisan('make:usecase', ['name' => $useCaseName])
            ->expectsOutput('Usecase created successfuly.')
            ->assertSuccessful();

        $this->assertFileExists(
            __DIR__ . '/../../domain/' . $useCaseName . '/' . $useCaseName . '.php'
        );
        $this->assertFileExists(
            __DIR__ . '/../../domain/' . $useCaseName . '/' . $useCaseName . 'Request.php'
        );
    }

        /** @test */
        public function it_create_all_files_with_namespace_argument()
        {
            $useCaseName = 'JohnDoe';
    
            $this->artisan(
                    'make:usecase', 
                    ['name' => $useCaseName, 'namespace' => 'Domain\\' . $useCaseName]
                )->expectsOutput('Usecase created successfuly.')
                ->assertSuccessful();
    
            $this->assertFileExists(
                __DIR__ . '/../../domain/' . $useCaseName . '/' . $useCaseName . '.php'
            );
            $this->assertFileExists(
                __DIR__ . '/../../domain/' . $useCaseName . '/' . $useCaseName . 'Request.php'
            );
            $this->assertFileExists(
                __DIR__ . '/../../domain/' . $useCaseName . '/' . $useCaseName . 'Response.php'
            );
            $this->assertFileExists(
                __DIR__ . '/../../domain/' . $useCaseName . '/' . $useCaseName . 'Presenter.php'
            );
            $this->assertFileExists(
                __DIR__ . '/../../domain/' . $useCaseName . '/' . $useCaseName . 'PresenterInterface.php'
            );
        }
}
