<?php

namespace Sankokai\UseCase\Tests\Feature;

use Sankokai\Usecase\Tests\TestCase;

class MakeTestCaseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_launch_usecase_command()
    {
        $this->artisan('make:usecase', ['name' =>'John'])
            ->expectsOutput('Usecase created successfuly.')
            ->assertSuccessful();
           
        // $this->artisan('make:usecase')->assertSuccessful();
    }
}
