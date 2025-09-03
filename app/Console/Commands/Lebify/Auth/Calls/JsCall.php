<?php

namespace App\Console\Commands\Lebify\Auth\Calls;

use App\Console\Commands\Lebify\Auth\Create\CreateFolders;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Auth\UpdateEmailFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Auth\UpdateLoginFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Auth\UpdateRegisterFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Auth\UpdateResetPasswordFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Auth\UpdateVerifyFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base\UpdateConfigFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base\UpdateErrorFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base\UpdateformHandlerFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base\UpdateLoadingButtonFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base\UpdateRequestFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base\UpdateScriptLoader;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base\UpdateSweetAlertFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base\UpdateToastFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base\UpdateUtilsFile;
use App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Core\UpdateControllersCommonFile;
use App\Console\Commands\Lebify\Auth\Update\UpdatePackages\UpdateIziToastPackage;
use Illuminate\Console\Command;


class JsCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call:js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call all JavaScript-related commands';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // create folders
        $this->info('Creating JavaScript folder structure...');
        $this->call(CreateFolders::class);
        $this->info('JavaScript folder structure created successfully.');
        sleep(1);

        // update config file
        $this->info('Updating config.js file...');
        $this->call(UpdateConfigFile::class);
        $this->info('config.js file updated successfully.');
        sleep(1);

        // update request file
        $this->info('Updating request.js file...');
        $this->call(UpdateRequestFile::class);
        $this->info('request.js file updated successfully.');
        sleep(1);

        // update scriptLoader file
        $this->info('Updating scriptLoader.js file...');
        $this->call(UpdateScriptLoader::class);
        $this->info('scriptLoader.js file updated successfully.');
        sleep(1);

        // update toast file
        $this->info('Updating toast.js file...');
        $this->call(UpdateToastFile::class);
        $this->info('toast.js file updated successfully.');
        sleep(1);

        $this->info('Updating sweetAlert.js file...');
        $this->call(UpdateSweetAlertFile::class);
        $this->info('sweetAlert.js file updated successfully.');
        sleep(1);

        // update utils file
        $this->info('Updating utils.js file...');
        $this->call(UpdateUtilsFile::class);
        $this->info('utils.js file updated successfully.');
        sleep(1);

        // update login file
        $this->info('Updating login.js file...');
        $this->call(UpdateLoginFile::class);
        $this->info('login.js file updated successfully.');
        sleep(1);

        // update register file
        $this->info('Updating register.js file...');
        $this->call(UpdateRegisterFile::class);
        $this->info('register.js file updated successfully.');
        sleep(1);

        // update loadingButton file
        $this->info('Updating loadingButton.js file...');
        $this->call(UpdateLoadingButtonFile::class);
        $this->info('loadingButton.js file updated successfully.');
        sleep(1);

        // update error file
        $this->info('Updating error.js file...');
        $this->call(UpdateErrorFile::class);
        $this->info('error.js file updated successfully.');
        sleep(1);

        // update formHandler file
        $this->info('Updating formHandler.js file...');
        $this->call(UpdateformHandlerFile::class);
        $this->info('formHandler.js file updated successfully.');
        sleep(1);

        // update auth file
        $this->info('Updating auth.js file...');
        $this->call(UpdateControllersCommonFile::class);
        $this->info('auth.js file updated successfully.');
        sleep(1);

        // update iziToast package
        $this->info('Updating iziToast package...');
        $this->call(UpdateIziToastPackage::class);
        $this->info('iziToast package updated successfully.');
        sleep(1);

        // update email.js file
        $this->info('Updating email.js file...');
        $this->call(UpdateEmailFile::class);
        $this->info('email.js file updated successfully.');

        // update reset.js file
        $this->info('Updating reset.js file...');
        $this->call(UpdateResetPasswordFile::class);
        $this->info('reset.js file updated successfully.');

        // update verify.js file
        $this->info('Updating verify.js file...');
        $this->call(UpdateVerifyFile::class);
        $this->info('verify.js file updated successfully.');
        sleep(1);

        $this->info('All JavaScript-related commands executed successfully.');
    }
}
