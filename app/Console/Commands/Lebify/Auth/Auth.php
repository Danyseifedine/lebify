<?php

namespace App\Console\Commands\Lebify\Auth;

use Illuminate\Console\Command;

class Auth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lebify:auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Lebifying your Auth application...');

        $this->call('download:ui');
        $this->call('update:routes');
        $this->call('update:user-model');
        $this->call('setup:localization');
        $this->call('update:mail');
        $this->call("call:controller");
        $this->call("call:js");
        $this->call("call:ui");
        $this->call("call:css");
        $this->call("update:default-mail");

        if ($this->confirm('Do you want to include translations in your project?')) {
            $this->call("call:translation");
        }

        sleep(1);
        $this->info('Lebification completed successfully!');
    }
}
