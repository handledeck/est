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
        $d=new datas();
        $d->something();
        Artisan::call("migrate");

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

class datas {

    function __construct(){
        if(!file_exists("database/db.sqlite")){
            $dbf=fopen("database/db.sqlite","w");
            fclose($dbf);
        }
    }
    public function something(){
        // some code
        $env_update = $this->changeEnv([
            'DB_DATABASE'   => '../database/db.sqlite',
            'DB_USERNAME'   => 'root',
            'DB_HOST'       => 'root'
        ]);
        if($env_update){
            // Do something
        } else {
            // Do something else
        }
        // more code
    }

    protected function changeEnv($data = array()){
        if(count($data) > 0){

            // Read .env-file
            $env = file_get_contents('.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value){

                // Loop through .env-data
                foreach($env as $env_key => $env_value){

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents('.env', $env);

            return true;
        } else {
            return false;
        }
    }
}