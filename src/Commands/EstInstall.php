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
    }
}
