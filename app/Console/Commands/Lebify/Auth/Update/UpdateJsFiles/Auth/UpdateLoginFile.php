<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Auth;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateLoginFile extends Command
{
    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:login-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the login.js file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $loginJsFilePath = public_path('js/auth/login.js');

        $code = <<<'JS'
import { $SingleFormPostController } from '../common/core/controllers.js';
import { ENDPOINT, __API_CFG__ } from "../common/base/config/config.js";

const loginConfig = {
    formSelector: '#login-form',
    buttonSelector: '#login-form button[type="submit"]',
    feedback: true,
    endpoint: `${__API_CFG__.BASE_URL}${ENDPOINT.AUTHENTICATION.LOGIN}`,
    onSuccess: (res) => {
        window.location.href = res.redirect;
    },
}

const login = new $SingleFormPostController(loginConfig)
login.init();
JS;

        $this->addCodeToFile($loginJsFilePath, $code);

        $this->info('The login.js file has been updated successfully.');
    }
}
