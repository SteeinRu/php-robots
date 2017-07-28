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
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('robots', function () {
            return new Robots();
        });
    }

}