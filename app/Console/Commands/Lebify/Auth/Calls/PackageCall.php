<?php

namespace App\Console\Commands\Lebify\Auth\Calls;

use App\Console\Commands\Lebify\Auth\Update\UpdatePackages\UpdateIziToastPackage;
use App\Console\Commands\Lebify\Auth\Update\UpdatePackages\UpdateSweetAlertPackage;
use Illuminate\Console\Command;

class PackageCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call:package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call all Package-related commands';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // update iziToast package
        $this->info('Updating iziToast package...');
        $this->call(UpdateIziToastPackage::class);
        $this->info('iziToast package updated successfully.');
        sleep(1);

        // update sweetAlert package
        $this->info('Updating sweetAlert package...');
        $this->call(UpdateSweetAlertPackage::class);
        $this->info('sweetAlert package updated successfully.');
        sleep(1);

        $this->info('All JavaScript-related commands executed successfully.');
    }
}
