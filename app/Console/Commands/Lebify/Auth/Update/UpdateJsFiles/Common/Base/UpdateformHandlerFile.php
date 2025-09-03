<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateformHandlerFile extends Command
{
    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:formHandler-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the formHandler.js file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $formhandlerJsFilePath = public_path('js/common/base/formHandler/formHandler.js');

        $code = <<<'JS'
import { __FORM_CFG__ } from "../config/config.js";

/**
 * Class for handling form validation and submission.
 */
export class FormHandler {
    /**
     * Clears the validation feedback by removing the appropriate classes and error messages.
     */
    static clearValidationFeedback() {
        document.querySelectorAll(`.${__FORM_CFG__.INVALID_FIELD_CLASS}`).forEach(element => element.classList.remove(__FORM_CFG__.INVALID_FIELD_CLASS));
        document.querySelectorAll('.invalid-feedback').forEach(message => message.remove());
    }

    /**
     * Attaches a form submit handler to the specified form element.
     * @param {HTMLFormElement} form - The form element to attach the handler to.
     * @param {Function} handleSubmit - The callback function to handle form submission.
     * @param {Object} [options] - Additional options for the form submit handler.
     * @param {boolean} [options.preventDefault=true] - Whether to prevent the default form submission behavior.
     * @param {Function} [options.errorCallback] - A callback function to handle errors that occur during form submission.
     */
    static formListener(form, handleSubmit, options = {}) {
        if (!(form instanceof HTMLFormElement)) {
            throw new Error('The "form" parameter must be an HTMLFormElement.');
        }

        if (typeof handleSubmit !== 'function') {
            throw new TypeError('The "handleSubmit" parameter must be a function.');
        }

        const { preventDefault = true, errorCallback } = options;

        form.addEventListener('submit', async (event) => {
            if (preventDefault) {
                event.preventDefault();
            }
            try {
                const formData = new FormData(event.target);
                await handleSubmit(formData);
            } catch (error) {
                if (errorCallback && typeof errorCallback === 'function') {
                    errorCallback(error);
                } else {
                    console.error('Error handling form submission:', error);
                }
            }
        });
    }
}
JS;

        $this->addCodeToFile($formhandlerJsFilePath, $code);
        $this->info('The formHandler.js file has been updated successfully.');
    }
}
