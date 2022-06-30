<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class TraitGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Default trait sstructure';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
    * Return the stub file path
    * @return string
    *
    */
    public function getStubPath()
    {
        return __DIR__ . '/../../../stubs/Trait.stub';
    }

    public function getSingularClassName($name){
        return ucfirst($name);
    }

    /**
    **
    * Map the stub variables present in stub to its value
    *
    * @return array
    *
    */
    public function getStubVariables()
    {
        return [
        'NAMESPACE' => 'App\\Trait',
        'CLASS_NAME' => $this->getSingularClassName($this->argument('name')),
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
            $contents = str_replace('$'.$search.'$' , $replace, $contents);
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
        return base_path('App\\Trait') .'\\' .$this->getSingularClassName($this->argument('name')) . 'Trait.php';
    }
    /**
    * Filesystem instance
    * @var Filesystem
    */
    protected $files;


    /**
    * Build the directory for the class if necessary.
    *
    * @param string $path
    * @return string
    */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

    return $path;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = $this->getSourceFilePath();

        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        if (!$this->files->exists($path)) {
        $this->files->put($path, $contents);
        $this->info("Trait successfully created ");
        } else {
        $this->info("Trait : {$path} already exits");
        }

        return 0;
    }
}
