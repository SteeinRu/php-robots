<?php
namespace Steein\Robots\Laravel;

use Illuminate\Support\ServiceProvider;
use Steein\Robots\Robots;

class RobotsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('steein/robots');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['robots'] = $this->app->share(function($app)
        {
            return new Robots();
        });

        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Robots', 'Steein\Robots\Laravel\RobotsFacade');
        });
    }

}