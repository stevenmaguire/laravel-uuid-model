<?php namespace Stevenmaguire\Laravel\Database;

use Illuminate\Database\Migrations\MigrationCreator as BaseMigrationCreator;

class MigrationCreator extends BaseMigrationCreator
{
    /**
     * Get the path to the stubs.
     *
     * @return string
     */
    public function getStubPath()
    {
        return __DIR__.'/stubs';  // @codeCoverageIgnore
    }
}
