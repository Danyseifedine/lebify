<?php

namespace App\Console\Commands\Lebify\Dashboard\Layout;

use Illuminate\Console\Command;

class Call extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lebify:dashboard-call-layout-component {--light-sidebar}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call a dashboard layout component';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('light-sidebar')) {
            $this->call('lebify:dashboard-layout', ['--light-sidebar' => true]);
            $this->call('lebify:dashboard-component-sidebar', ['--light-sidebar' => true]);
        } else {
            $this->call('lebify:dashboard-layout');
            $this->call('lebify:dashboard-component-sidebar');
        }
        sleep(1);
        $this->call('lebify:dashboard-component-navbar');
        sleep(1);
        $this->call('lebify:dashboard-component-footer');
    }
}
