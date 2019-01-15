<?php

namespace Anakadote\BAMLT;

use Illuminate\Support\ServiceProvider;

class BAMLTServiceProvider extends ServiceProvider
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
        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Anakadote\BAMLT\Facades\BAMLT::class, function($app) {
            return new BAMLT;
        });
        
        $this->app['bamlt'] = $this->app->make(Anakadote\BAMLT\Facades\BAMLT::class);
        
        $this->app->booting(function() {
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
        return [];
    }

}