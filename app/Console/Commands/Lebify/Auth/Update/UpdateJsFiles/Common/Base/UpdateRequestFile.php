<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateRequestFile extends Command
{
    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:request-js';

    protected $description = 'Update the request.js file with the provided code';

    public function handle()
    {
        $requestJsFilePath = public_path('js/common/base/api/request.js');

        $code = <<<'JS'
import { ErrorHandler } from "../error/error.js";
import { __API_CFG__ } from "../config/config.js";

/**
 * Class for handling HTTP requests.
 *
 * @class HttpRequest
 * @example
 * // Create an instance of HttpRequest
 * const httpRequest = new HttpRequest();
 *
 * @example
 * // Make a GET request
 * HttpRequest.get('/api/data')
 *   .then(response => console.log(response))
 *   .catch(error => console.error(error));
 *
 * @example
 * // Make a POST request
 * HttpRequest.post('/api/data', { key: 'value' })
 *   .then(response => console.log(response))
 *   .catch(error => console.error(error));
 *
 * Available methods:
 * - static async makeRequest(method, url, data = null, headers = {}, errorCallback = ErrorHandler.handleError)
 * - static async get(url, headers = {})
 * - static async post(url, data, headers = {})
 * - static async put(url, data, headers = {})
 * - static async patch(url, data, headers = {})
 * - static async del(url, headers = {})
 */
export class HttpRequest {

    /**
     * Constructs a new instance of the HttpRequest class.
     * Initializes the CSRF token setup.
     */
    constructor() {
        this.setupCSRFToken();
    }

    /**
     * Sets up the CSRF token for requests.
     * Retrieves the CSRF token from the document and sets it in axios defaults.
     * Logs an error if the CSRF token is not found.
     */
    setupCSRFToken() {
        const csrfToken = document.querySelector(__API_CFG__.CSRF_TOKEN_SELECTOR)?.getAttribute('content');
        if (csrfToken) {
            axios.defaults.headers.common[__API_CFG__.CSRF_TOKEN_HEADER] = csrfToken;
        } else {
            console.error(__API_CFG__.CSRF_TOKEN_ERROR);
        }
    }

    /**
     * Makes an HTTP request.
     * @param {string} method - The HTTP method (e.g., 'get', 'post', 'put', 'patch', 'delete').
     * @param {string} url - The URL for the request.
     * @param {any} [data=null] - The request data (for methods like POST, PUT, PATCH).
     * @param {Object} [headers={}] - The request headers.
     * @param {Function} [errorCallback=ErrorHandler.handleError] - The error callback function.
     * @returns {Promise<any>} - The response data.
     */
    static async makeRequest(method, url, data = null, headers = {}, errorCallback = ErrorHandler.handleError) {
        try {
            const response = await axios({
                method,
                url,
                data,
                headers,
                timeout: __API_CFG__.REQUEST_TIMEOUT
            });
            return response.data;
        } catch (error) {
            if (error.response) {
                ErrorHandler.handleErrorResponse(error.response, errorCallback);
            } else {
                ErrorHandler.handleError(error);
            }
            throw error;
        }
    }

    /**
     * Makes a GET request.
     * @param {string} url - The URL for the request.
     * @param {Object} [headers={}] - The request headers.
     * @returns {Promise<any>} - The response data.
     */
    static async get(url, headers = {}) {
        return await this.makeRequest('get', url, null, headers);
    }

    /**
     * Makes a POST request.
     * @param {string} url - The URL for the request.
     * @param {any} data - The request data.
     * @param {Object} [headers={}] - The request headers.
     * @returns {Promise<any>} - The response data.
     */
    static async post(url, data, headers = {}) {
        return await this.makeRequest('post', url, data, headers);
    }

    /**
     * Makes a PUT request.
     * @param {string} url - The URL for the request.
     * @param {any} data - The request data.
     * @param {Object} [headers={}] - The request headers.
     * @returns {Promise<any>} - The response data.
     */
    static async put(url, data, headers = {}) {
        return await this.makeRequest('put', url, data, headers);
    }

    /**
     * Makes a PATCH request.
     * @param {string} url - The URL for the request.
     * @param {any} data - The request data.
     * @param {Object} [headers={}] - The request headers.
     * @returns {Promise<any>} - The response data.
     */
    static async patch(url, data, headers = {}) {
        return await this.makeRequest('patch', url, data, headers);
    }

    /**
     * Makes a DELETE request.
     * @param {string} url - The URL for the request.
     * @param {Object} [headers={}] - The request headers.
     * @returns {Promise<any>} - The response data.
     */
    static async del(url, headers = {}) {
        return await this.makeRequest('delete', url, null, headers);
    }
}
JS;

        $this->addCodeToFile($requestJsFilePath, $code);
        $this->info('The request.js file has been updated successfully.');
    }
}
