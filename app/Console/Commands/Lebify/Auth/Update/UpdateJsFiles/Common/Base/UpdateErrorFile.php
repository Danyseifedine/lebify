<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateErrorFile extends Command
{
    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:error-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the error.js file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $errorJsFile = public_path('js/common/base/error/error.js');

        $code = <<<'JS'
import { Toast } from "../messages/toast.js";
import { __FORM_CFG__ } from "../config/config.js";

export class ErrorHandler {
    /**
     * Handles errors by logging them to the console.
     * @param {Error} error - The error object.
     */
    static handleError(error) {
        console.error('Error:', error);
    }

    /**
     * Handles form validation errors by adding the appropriate classes and error messages.
     * @param {Object} validationError - The validation error object.
     */
    static handleValidationError(validationError, form) {

        Object.keys(validationError).forEach(field => {
            const inputField = form.querySelector(`#${field}`);
            if (inputField) {
                inputField.classList.add(__FORM_CFG__.INVALID_FIELD_CLASS);
                inputField.insertAdjacentHTML('afterend', `<div class="${__FORM_CFG__.INVALID_FEEDBACK_CLASS}">${validationError[field][0]}</div>`);
            }
        });
    }

    /**
     * Handles error responses from the server.
     * @param {Object} response - The error response object.
     * @param {Function} errorCallback - The error callback function.
     */
    static handleErrorResponse(response, errorCallback) {
        const status = response.status;
        switch (status) {
            case 422:
                // handler Validation error
                // this.handleValidationError(response.data.errors);
                break;
            case 401:
                this.handleUnauthorizedError(response);
                break;
            case 403:
                this.handleForbiddenError(response);
                break;
            case 404:
                errorCallback('Resource not found');
                break;
            case 500:
                errorCallback('Internal server error');
                break;
            case 503:
                this.handleServiceUnavailableError(response);
                break;
            default:
                errorCallback('An unexpected error occurred');
                break;
        }
    }

    /**
     * Handles unauthorized errors.
     * @param {Object} response - The error response object.
     */
    static handleUnauthorizedError(response) {
        window.location.href = '/login';
    }

    /**
     * Handles forbidden errors.
     * @param {Object} response - The error response object.
     */
    static handleForbiddenError(response) {
        Toast.showErrorToast('Access Denied', 'You do not have permission to access this resource.');
    }

    /**
     * Handles service unavailable errors.
     * @param {Object} response - The error response object.
     */
    static handleServiceUnavailableError(response) {
        Toast.showErrorToast('Service Unavailable', 'The service is currently unavailable. Please try again later.');
    }
}
JS;

        $this->addCodeToFile($errorJsFile, $code);
        $this->info('The error.js file has been updated successfully.');
    }
}
