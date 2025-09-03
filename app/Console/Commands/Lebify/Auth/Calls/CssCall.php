<?php

namespace App\Console\Commands\Lebify\Auth\Calls;

use App\Console\Commands\Lebify\Auth\Update\UpdateCssFiles\AppCssFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateCssFiles\LoadingCssFile;
use Illuminate\Console\Command;

class CssCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call:css';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Start loading css files');
        $this->call(LoadingCssFile::class);
        $this->info('Loading css files loaded');
        sleep(1);
        $this->info('Start App css files');
        $this->call(AppCssFile::class);
        $this->info('App css files loaded');
        sleep(1);
    }
}
