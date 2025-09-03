<?php

namespace App\Console\Commands\Lebify\Auth\Download;

use Illuminate\Console\Command;

class DownloadUi extends Command
{
    protected $signature = 'download:ui';
    protected $description = 'Download Laravel UI and setup';

    public function handle()
    {
        $this->info('Downloading Laravel UI...');
        exec('composer require laravel/ui', $output, $returnValue);

        if ($returnValue !== 0) {
            $this->error('Error occurred while downloading Laravel UI.');
            return;
        }

        $this->info('Setting up Laravel UI (Bootstrap)...');
        $this->confirm('Press enter to continue...');
        exec('php artisan ui bootstrap', $output, $returnValue);

        if ($returnValue !== 0) {
            $this->error('Error occurred while setting up Laravel UI (Bootstrap).');
            return;
        }

        $this->info('Setting up Laravel UI (Bootstrap with Auth)...');
        // Add authentication views without manual confirmation
        exec('yes | php artisan ui bootstrap --auth', $output, $returnValue);

        if ($returnValue !== 0) {
            $this->error('Error occurred while setting up Laravel UI (Bootstrap with Auth).');
            return;
        }

        $this->info('Installing npm dependencies...');
        exec('npm install', $output, $returnValue);

        if ($returnValue !== 0) {
            $this->error('Error occurred while installing npm dependencies.');
            return;
        }

        $this->info('Setup completed successfully.');
        echo "\n";
        $this->info('Please run "npm run dev" to compile your fresh scaffolding.');
    }
}
