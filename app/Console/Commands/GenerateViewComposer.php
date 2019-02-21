<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class GenerateViewComposer extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:viewcomposer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a new view composer.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'ViewComposer';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return app_path('\\Console\\Stubs\\ViewComposer.stub');
    }

    /**
    * Get the default namespace for the class.
    *
    * @param  string  $rootNamespace
    * @return string
    */
    protected function getDefaultNamespace($rootNamespace)
    {
        return "{$rootNamespace}\\ViewComposers";
    }
}
