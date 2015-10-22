<?php namespace Stevenmaguire\Laravel\Test;

use Mockery as m;
use Illuminate\Config\Repository;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Bootstrap\ConfigureLogging;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;
use Illuminate\Foundation\Bootstrap\RegisterFacades;
use Illuminate\Foundation\Composer;
use Illuminate\Foundation\Console\Kernel;
use Stevenmaguire\Laravel\Providers\UuidArtisanProvider;

class UuidArtisanProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testServiceProvidersAreCorrectlyRegistered()
    {
        $app = m::mock(Application::class)->makePartial();
        $provider = new UuidArtisanProvider($app);
        $class = get_class($provider);
        $composer = m::mock(Composer::class);
        $events = m::mock(Dispatcher::class);
        $events->shouldReceive('listen');
        $events->shouldReceive('fire');
        $files = m::mock(Filesystem::class);
        $configService = m::mock(LoadConfiguration::class);
        $configService->shouldReceive('bootstrap')->with($app);
        $configuration = m::mock(Repository::class);
        $configuration->shouldReceive('offsetGet');
        $configuration->shouldReceive('get');
        $logService = m::mock(LoadConfiguration::class);
        $logService->shouldReceive('bootstrap')->with($app);
        $facadeService = m::mock(RegisterFacades::class);
        $facadeService->shouldReceive('bootstrap')->with($app);
        $app->singleton(ConfigureLogging::class, function () use ($logService) { return $logService; });
        $app->singleton(LoadConfiguration::class, function () use ($configService) { return $configService; });
        $app->singleton(RegisterFacades::class, function () use ($facadeService) { return $facadeService; });
        $app->singleton('composer', function () use ($composer) { return $composer; });
        $app->singleton('config', function () use ($configuration) { return $configuration; });
        $app->singleton('events', function () use ($events) { return $events; });
        $app->singleton('files', function () use ($files) { return $files; });
        $app->register($provider);
        $this->assertTrue(in_array($class, $app->getLoadedProviders()));
        $this->assertTrue(is_array($provider->provides()));

        $migrationMakeCommand = $app->make('command.migrate.make');
        $modelMakeCommand = $app->make('command.model.make');

        //$artisan = m::mock(Kernel::class, [$app, $events])->makePartial();
        //$artisan->call('make:migration');
        //$artisan->call('make:model');
    }
}
