<?php

namespace Katsana\Prefetch\Console;

use Orchestra\Canvas\Core\Commands\GeneratorCommand;

class MakePrefetchCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:prefetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Prefetch Request class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Request';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->getStubFile();
    }

    /**
     * Get the stub file for the generator.
     */
    public function getStubFile(): string
    {
        return __DIR__.'/stubs/request.stub';
    }

    /**
     * Get the default namespace for the class.
     */
    public function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Http\Prefetch';
    }

    /**
     * Generator options.
     */
    public function generatorOptions(): array
    {
        return [
            'name' => $this->generatorName(),
        ];
    }
}
