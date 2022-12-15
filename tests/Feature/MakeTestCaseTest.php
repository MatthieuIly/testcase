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
        $this->artisan('usecase:create')
            ->expectsOutput('Usecase created successfuly.');

        $this->artisan('usecase:create')->assertSuccessful();
    }
}
