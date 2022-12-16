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
    protected $signature = 'make:usecase {name}';

    protected $description = 'Create a UseCase';

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $files;

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

        $path = $this->getSourceFilePath();

        // dd(dirname($path));
        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        // if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File : {$path} created");
        // } else {
        //     $this->info("File : {$path} already exits");
        // }
    
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
     * Return the stub file path
     * @return string
     *
     */
    public function getStubPath()
    {
        return __DIR__ . '/../../stubs/domain/UseCase/Usecase.stub';
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
            '{{ namespace }}' => $this->getSingularClassName($this->argument('name')),
            '{{ useCase }}'   => $this->getSingularClassName($this->argument('name')),
        ];
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
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
            // (\{{2})(\s*)(\w*\d*)(\s*)(\}{2})
            $contents = preg_replace('/(\{{2})(\s*)(\w*\d*)(\s*)(\}{2})/', $replace, $contents);
            // dump($search);
            // dump($replace);
            // dump($contents);
            //$contents = str_replace('$'.$search.'$' , $replace, $contents);
        }

        return $contents;

    }

    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceFilePath()
    {
        return base_path() . '/domain/' . 
            $this->getSingularClassName($this->argument('name')) . '/' .
            $this->getSingularClassName($this->argument('name')) . '.php';
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
