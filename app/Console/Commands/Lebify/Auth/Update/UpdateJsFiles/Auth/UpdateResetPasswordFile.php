<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Auth;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateResetPasswordFile extends Command
{
    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:reset-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the reset.js file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $loginJsFilePath = public_path('js/auth/reset.js');

        $code = <<<'JS'
import { ENDPOINT, __API_CFG__ } from "../common/base/config/config.js";
import { $SingleFormPostController } from "../common/core/controllers.js";

let resetConfig = {
    formSelector: '#reset-form',
    buttonSelector: '#reset-form button[type="submit"]',
    endpoint: `${__API_CFG__.BASE_URL}${ENDPOINT.AUTHENTICATION.RESET_PASSWORD}`,
    feedback: true,

    onSuccess: (res) => {
        window.location.href = res.redirect;
    },

    onError: (error) => {
        console.log(error);
    }
}

let reset = new $SingleFormPostController(resetConfig)
reset.init();
JS;

        $this->addCodeToFile($loginJsFilePath, $code);
        $this->info('The reset.js file has been updated successfully.');
    }
}
