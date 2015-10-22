<?php namespace Stevenmaguire\Laravel\Console;

use Illuminate\Foundation\Console\ModelMakeCommand as BaseModelMakeCommand;

class ModelMakeCommand extends BaseModelMakeCommand
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/model.stub'; // @codeCoverageIgnore
    }
}
