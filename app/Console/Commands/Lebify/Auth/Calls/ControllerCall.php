<?php

namespace App\Console\Commands\Lebify\Auth\Calls;

use App\Console\Commands\Lebify\Auth\Update\UpdateControllerFiles\UpdateLoginController;
use App\Console\Commands\Lebify\Auth\Update\UpdateControllerFiles\UpdateRegisterController;
use App\Console\Commands\Lebify\Auth\Update\UpdateControllerFiles\UpdateResetPasswordControllerFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateControllerFiles\UpdateVerificationController;
use Illuminate\Console\Command;

class ControllerCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call all Controller-related commands';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // update LoginController file
        $this->info('Updating LoginController.php file...');
        $this->call(UpdateLoginController::class);
        $this->info('LoginController.php file updated successfully.');
        sleep(1);

        // update VerificationController file
        $this->info('Updating VerificationController.php file...');
        $this->call(UpdateVerificationController::class);
        $this->info('VerificationController.php file updated successfully.');
        sleep(1);

        // update RegisterController file
        $this->info('Updating RegisterController.php file...');
        $this->call(UpdateRegisterController::class);
        $this->info('RegisterController.php file updated successfully.');
        sleep(1);

        // update resetPasswordController file
        $this->info('Updating ResetPasswordController.php file...');
        $this->call(UpdateResetPasswordControllerFile::class);
        $this->info('ResetPasswordController.php file updated successfully.');
        sleep(1);


        $this->info('All Controller-related commands executed successfully.');
    }
}
