<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Auth;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateLogoutFile extends Command
{

    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:logout-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the logout.js file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $logoutJsFilePath = public_path('js/auth/logout.js');

        $code = <<<'JS'
JS;

        $this->addCodeToFile($logoutJsFilePath, $code);
        $this->info('The logout.js file has been updated successfully.');
    }
}
