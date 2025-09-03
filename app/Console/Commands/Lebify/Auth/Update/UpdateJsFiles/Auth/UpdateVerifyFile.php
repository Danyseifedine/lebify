<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Auth;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateVerifyFile extends Command
{

    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:verify-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the verify.js file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $loginJsFilePath = public_path('js/auth/verify.js');

        $code = <<<'JS'
import { Toast } from '../common/base/messages/toast.js';
import { ENDPOINT, __API_CFG__ } from '../common/base/config/config.js';
import { $SingleFormPostController } from '../common/core/controllers.js';

const sendVerificationEmailConfig = {
    formSelector: '#verify-form',
    buttonSelector: '#verify-form button[type="submit"]',
    endpoint: `${__API_CFG__.BASE_URL}${ENDPOINT.AUTHENTICATION.VERIFY_EMAIL}`,
    feedback: false,
    onSuccess: (res) => {
        Toast.showSuccessToast('', res.message);
    },
}

const sendVerificationEmail = new $SingleFormPostController(sendVerificationEmailConfig)
sendVerificationEmail.init();
JS;

        $this->addCodeToFile($loginJsFilePath, $code);
        $this->info('The verify.js file has been updated successfully.');
    }
}
