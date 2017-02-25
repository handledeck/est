<?php

namespace Handledeck\EstTools;


use Illuminate\Support\ServiceProvider;


class EstToolsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../public/css' => public_path('est/css')
        ], 'public');
        $this->publishes([
            __DIR__ . '/../public/js' => public_path('est/js')
        ], 'public');
        $this->publishes([
            __DIR__ . '/../public/fonts' => public_path('est/fonts')
        ], 'public');
        $this->publishes([
            __DIR__ . '/../public/images' => public_path('est/images')
        ], 'public');
	$this->publishes([
            __DIR__ . '/../views' => public_path('../resources/views')
        ], 'public');
        //\Artisan::registerCommand(new EstInstall());
/*        $this->app->bind('est:install', function ($app) {
            return new EstInstall();
        });
        $this->commands([
            'est:install'
        ]);*/
        include __DIR__ . '/routes.php';
        
    }


    protected $command=['Handledeck\EstTools\Commands\EstInstall'];

    public function register()
    {
        \App::bind("Est", function () {
            return new Est();
        });
        $this->commands($this->command);
    }
}