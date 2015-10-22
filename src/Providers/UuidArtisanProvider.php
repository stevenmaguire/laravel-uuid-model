<?php namespace Stevenmaguire\Laravel\Providers;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Illuminate\Support\ServiceProvider;
use Stevenmaguire\Laravel\Console\ModelMakeCommand;
use Stevenmaguire\Laravel\Database\MigrationCreator;

class UuidArtisanProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'MigrationMake' => 'command.migrate.make',
        'ModelMake' => 'command.model.make',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        foreach (array_keys($this->commands) as $command) {
            $method = "register{$command}Command";

            call_user_func_array([$this, $method], []);
        }

        $this->commands(array_values($this->commands));
    }

    /**
     * Register the "make" migration command.
     *
     * @return void
     */
    protected function registerMigrationMakeCommand()
    {
        $this->registerCreator();

        $this->app->singleton('command.migrate.make', function ($app) {
            // Once we have the migration creator registered, we will create the command
            // and inject the creator. The creator is responsible for the actual file
            // creation of the migrations, and may be extended by these developers.
            $creator = $app['migration.creator'];

            $composer = $app['composer'];

            return new MigrateMakeCommand($creator, $composer);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerModelMakeCommand()
    {
        $this->app->singleton('command.model.make', function ($app) {
            return new ModelMakeCommand($app['files']);
        });
    }

    /**
     * Register the migration creator.
     *
     * @return void
     */
    protected function registerCreator()
    {
        $this->app->singleton('migration.creator', function ($app) {
            return new MigrationCreator($app['files']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array_values($this->commands);
    }
}
