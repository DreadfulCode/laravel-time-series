<?php

namespace TimothePearce\TimeSeries\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CreateProjectionCommand extends GeneratorCommand
{
    /**
     * The name of the console command.
     *
     * @var string
     */
    public $name = 'make:projection';

    /**
     * The console command description.
     *
     * @var string
     */
    public $description = 'Create a new projection model';

    /**
     * Get the stub used for the file generation.
     */
    protected function getStub()
    {
        return $this->option('key') ?
            __DIR__ . '/stubs/KeyedProjection.php.stub' :
            __DIR__ . '/stubs/Projection.php.stub';
    }

    /**
     * Get the default namespace of the generated class.
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models\Projections';
    }

    /**
     * Get the options of the command.
     */
    protected function getOptions()
    {
        return [
            ['key', null, InputOption::VALUE_NONE, 'Add a key method to the generated class'],
        ];
    }

    /**
     * Executes the command operations.
     */
    public function handle()
    {
        parent::handle();

        $class = $this->qualifyClass($this->getNameInput());
        $path = $this->getPath($class);
        $content = file_get_contents($path);

        file_put_contents($path, $content);
    }
}
