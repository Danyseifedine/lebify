<?php

namespace App\Console\Commands\Lebify\Auth\Calls;

use App\Console\Commands\Lebify\Auth\Create\CreateViewFolder;
use App\Console\Commands\Lebify\Auth\Update\UpdateUiFiles\Auth\Components\UpdateFooterFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateUiFiles\Auth\UpdateAuthLayoutFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateUiFiles\Auth\UpdateLoginViewFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateUiFiles\Auth\UpdatePasswordResetFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateUiFiles\Auth\UpdateRegisterViewFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateUiFiles\Auth\UpdatesendPasswordResetFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateUiFiles\UpdateVerificationFile;
use Illuminate\Console\Command;

class UiCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call:ui';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call all ui-related commands';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Upadate auth layout
        $this->info('Updating auth layout file...');
        $this->call(UpdateLoginViewFile::class);
        $this->info('auth layout file updated successfully.');
        sleep(1);

        // Update Login file
        $this->info('Updating login file...');
        $this->call(UpdateRegisterViewFile::class);
        $this->info('login file updated successfully.');
        sleep(1);

        // Update register file
        $this->info('Updating register file...');
        $this->call(UpdateAuthLayoutFile::class);
        $this->info('register file updated successfully.');
        sleep(1);

        // Update email file
        $this->info('Updating email file...');
        $this->call(UpdatesendPasswordResetFile::class);
        $this->info('register email updated successfully.');

        // Update reset file
        $this->info('Updating reset file...');
        $this->call(UpdatePasswordResetFile::class);
        $this->info('register reset updated successfully.');
        sleep(1);

        // Update verification file
        $this->info('Updating verification file...');
        $this->call(UpdateVerificationFile::class);
        $this->info('verification file updated successfully.');
        sleep(1);

        // Update password file
        $this->info('Creating view folder...');
        $this->call(CreateViewFolder::class);
        $this->info('view folder created successfully.');
        sleep(1);

        // Update footer file
        $this->info('Updating footer file...');
        $this->call(UpdateFooterFile::class);
        $this->info('footer file updated successfully.');
    }
}
