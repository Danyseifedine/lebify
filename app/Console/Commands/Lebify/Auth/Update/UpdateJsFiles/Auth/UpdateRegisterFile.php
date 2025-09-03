<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Auth;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateRegisterFile extends Command
{

    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:register-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the register.js file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $loginJsFilePath = public_path('js/auth/register.js');

        $code = <<<'JS'
import { $SingleFormPostController } from '../common/core/controllers.js';
import { ENDPOINT, __API_CFG__ } from "../common/base/config/config.js";


const registerConfig = {
    formSelector: '#register-form',
    buttonSelector: '#register-form button[type="submit"]',
    feedback: true,
    endpoint: `${__API_CFG__.BASE_URL}${ENDPOINT.AUTHENTICATION.REGISTER}`,

    onSuccess: function (res) {
        window.location.href = res.redirect;
    }
}

const register = new $SingleFormPostController(registerConfig)
register.init();
JS;

        $this->addCodeToFile($loginJsFilePath, $code);
        $this->info('The register.js file has been updated successfully.');
    }
}
