<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Seed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Empty seed again.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        if(\App::environment('local')){
            $this->callSilent('down');
            $time_start = microtime(true); 
            $this->info('0%: Seed iniciado.');
            $this->callSilent('db:seed', ['--class'=>'DatabaseSeeder']);
            $this->info('50%: Base de datos llenada correctamente.');
            $this->info('100%: Seed finalizado.');
            $this->info('Total execution time in seconds: ' . (microtime(true) - $time_start));
            $this->callSilent('up');
        } else {
            $this->info('No autorizado.');
        }
    }
}