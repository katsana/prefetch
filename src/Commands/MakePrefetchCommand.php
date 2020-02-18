<?php

namespace Katsana\Prefetch\Commands;

use Orchestra\Canvas\Core\Commands\Generator;

class MakePrefetchCommand extends Generator
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:prefetch';

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
     */
    public function getStubFile(): string
    {
        return __DIR__.'/stubs/request.stub';
    }

    /**
     * Get the default namespace for the class.
     */
    public function getDefaultNamespace(string $rootNamespace): string
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
