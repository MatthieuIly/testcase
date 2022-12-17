<?php

namespace Sankokai\Usecase\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;

class UsecaseCommand extends Command
{
    /**
     * 
     * @var string
     */
    protected $signature = 'make:usecase {name} {namespace?}';

    protected $description = 'Create a UseCase';

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $files;

    /**
     * Stub paths and destinations
     * @var array
     */
    protected $stubs;

    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle()
    {
        $path = base_path() . '/domain/' .
            $this->getSingularClassName($this->argument('name')) . '/';
        
        $this->stubs = [
            [
                'stub' => __DIR__ . '/../../stubs/domain/UseCase/Usecase.stub',
                'dest' => $path . $this->getSingularClassName($this->argument('name')) . '.php',
            ],
            [
                'stub' => __DIR__ . '/../../stubs/domain/UseCase/UsecaseRequest.stub',
                'dest' => $path . $this->getSingularClassName($this->argument('name')) . 'Request.php',
            ],
            [
                'stub' => __DIR__ . '/../../stubs/domain/UseCase/UsecaseResponse.stub',
                'dest' => $path . $this->getSingularClassName($this->argument('name')) . 'Response.php',
            ],
            [
                'stub' => __DIR__ . '/../../stubs/domain/UseCase/UsecasePresenter.stub',
                'dest' => $path . $this->getSingularClassName($this->argument('name')) . 'Presenter.php',
            ],
            [
                'stub' => __DIR__ . '/../../stubs/domain/UseCase/UsecasePresenterInterface.stub',
                'dest' => $path . $this->getSingularClassName($this->argument('name')) . 'PresenterInterface.php',
            ]

        ];

        $this->makeDirectory(dirname($path));

        foreach ($this->stubs as $stub) {
            // if (!$this->files->exists($path)) {
            $contents = $this->getSourceFile($stub['stub']);
            $this->files->put($stub['dest'], $contents);
            $this->info("File : {$path} created");
            // $this->info("File : {$path} created");
            // } else {
            //     $this->info("File : {$path} already exits");
            // }
        }

        $this->line("Usecase created successfuly.");
    }

    /**
     * Return the Singular Capitalize Name
     * @param $name
     * @return string
     */
    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }

    /**
    **
    * Map the stub variables present in stub to its value
    *
    * @return array
    *ssw
    */
    public function getStubVariables()
    {
        return [
            '{{namespace}}' => $this->getSingularClassName($this->argument('namespace')),
            '{{useCase}}'   => $this->getSingularClassName($this->argument('name')),
        ];
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceFile($stubPath)
    {
        return $this->getStubContents($stubPath, $this->getStubVariables());
    }

    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub , $stubVariables = [])
    {
        $contents = file_get_contents($stub);
        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace($search, $replace, $contents);
        }
        return $contents;

    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }
        return $path;
    }
}
