<?php

namespace Anakadote\BAMLT;

use Illuminate\Support\ServiceProvider;

class BAMLTProvider extends ServiceProvider {

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
        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['bamlt'] = $this->app->share(function($app)
        {
            return new BAMLT;
        });
        
        // Register Facade
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('BAMLT', 'Anakadote\BAMLT\Facades\BAMLT');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
