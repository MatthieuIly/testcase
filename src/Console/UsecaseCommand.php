<?php

namespace Sankokai\Usecase\Console;

use Illuminate\Console\Command;

class UsecaseCommand extends Command
{
    /**
     * 
     * @var string
     */
    protected $signature = 'usecase:create';

    protected $description = 'Create a UseCase';

    public function handle()
    {
        $this->line("Usecase created successfuly.");
    }

}
