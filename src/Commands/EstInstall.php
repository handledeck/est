<?php

namespace Handledeck\EstTools\Commands;

use Illuminate\Console\Command;

class EstInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'packager:new {vendor} {name} {--i}';
    protected $signature = 'est:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->info("start configure est");
        $this->something();
        \Artisan::call("migrate");
        \Artisan::call("vendor:publish");
        \Artisan::call("up");
        exec("php composer dump-autoload");
        \Artisan::call("db:seed");
        \View::addLocation(realpath(__DIR__."../../../views"));
        $this->info("end configure est");
    }

    public $path="";

    public function something(){
        $this->path=realpath("")."\\database\\db.sqlite";
        if(!file_exists(realpath($this->path))){
            $dbf=fopen($this->path,"w");
            $this->info("create database OK");
            fclose($dbf);
        }

        $env_update = $this->changeEnv([
            'DB_DATABASE'   => $this->path,
            'DB_USERNAME'   => 'root',
            'DB_HOST'       => 'root'
        ]);
        $this->info("change env OK");
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

