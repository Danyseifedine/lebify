<?php

namespace App\Console\Commands\Lebify;

use Illuminate\Console\Command;

class Lebify extends Command
{
    protected $signature = 'lebify';
    protected $description = 'Run all the necessary commands to Lebify your Laravel application';

    public function handle()
    {
        $this->call('lebify:auth');
        $this->call('lebify:home');
    }
}
