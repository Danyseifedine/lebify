<?php

namespace App\Console\Commands\Lebify\Dashboard;

use Illuminate\Console\Command;

class Call extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lebify:dashboard {--light-sidebar}';

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
        info('Calling dashboard layout component');
        $this->call('lebify:dashboard-call-layout-component', ['--light-sidebar' => $this->option('light-sidebar')]);
        sleep(1);
        info('Calling dashboard route');
        $this->call('lebify:dashboard-route');
        sleep(1);
        info('Calling dashboard web route');
        $this->call('lebify:dashboard-web-route');
        sleep(1);
        info('Creating dashboard controllers');
        $this->call('lebify:dashboard-create-controllers');
        sleep(1);
        info('Creating dashboard views');
        $this->call('lebify:dashboard-create-folder-and-file');
    }
}
