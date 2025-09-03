<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateUtilsFile extends Command
{
    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:utils-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the utils.js file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $utilsJsFilePath = public_path('js/common/base/utils/utils.js');

        $code = <<<'JS'
import { __FORM_CFG__, __GENERAL_CFG__ } from "../config/config.js";
import { Toast } from "../messages/toast.js";



export class FunctionUtility {
    /**
     * Prevents multiple form submissions by temporarily disabling the submit button.
     * @param {HTMLElement} button - The submit button element.
     * @param {Object} config - The configuration object containing the timeout value.
     */
    static preventMultipleSubmission(button) {
        button.disabled = true;
        setTimeout(() => {
            button.disabled = false;
        }, __FORM_CFG__.PREVENT_MULTIPLE_SUBMISSION_TIMEOUT);
    }

    /**
     * Generates a random string of a specified length.
     * @param {number} length - The desired length of the random string.
     * @returns {string} The generated random string.
     */
    static generateRandomString(length = __GENERAL_CFG__.DEFAULT_RANDOM_STRING_LENGTH) {
        const chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        let result = '';
        for (let i = 0; i < length; i++) {
            result += chars[Math.floor(Math.random() * chars.length)];
        }
        return result;
    }

    /**
     * Debounces a function to prevent excessive calls.
     * @param {Function} func - The function to be debounced.
     * @param {number} delay - The delay in milliseconds before invoking the function.
     * @returns {Function} The debounced function.
     */
    static debounce(func, delay = __GENERAL_CFG__.DEBOUNCE_DELAY) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                func.apply(this, args);
            }, delay);
        };
    }

    /**
     * Throttles a function to limit the rate at which it can be called.
     * @param {Function} func - The function to be throttled.
     * @param {number} limit - The minimum time (in milliseconds) between function calls.
     * @returns {Function} The throttled function.
     */
    static throttle(func, limit = __GENERAL_CFG__.THROTTLE_LIMIT) {
        let lastCall = 0;
        return (...args) => {
            const now = Date.now();
            if (now - lastCall < limit) return;
            lastCall = now;
            return func.apply(this, args);
        };
    }

    /**
     * Clamps a value within a specified range.
     * @param {number} value - The value to be clamped.
     * @param {number} min - The minimum value of the range.
     * @param {number} max - The maximum value of the range.
     * @returns {number} The clamped value.
     */
    static clamp(value, min, max) {
        return Math.max(min, Math.min(max, value));
    }

    /**
     * Generates a unique ID based on the current timestamp and a random string.
     * @returns {string} The unique ID.
     */
    static generateUniqueId() {
        const timestamp = Date.now().toString(36);
        const randomString = generateRandomString(5);
        return `${timestamp}-${randomString}`;
    }

    /**
     * Capitalizes the first letter of a string.
     * @param {string} str - The input string.
     * @returns {string} The string with the first letter capitalized.
     */
    static capitalizeFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    /**
     * Copies text to the clipboard.
     * @param {string} text - The text to be copied.
     * @returns {Promise<void>} A Promise that resolves when the text is copied.
     */
    static async copyToClipboard(text) {
        try {
            await navigator.clipboard.writeText(text);
            Toast.showSuccessToast('', 'The text has been copied to your clipboard.');
        } catch (err) {
            Toast.showErrorToast('', 'Failed to copy text: ' + err);
        }
    }

    /**
     * Retrieves the value of a query parameter from the URL.
     * @param {string} name - The name of the query parameter.
     * @returns {string|null} The value of the query parameter, or null if not found.
     */
    static getQueryParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name) || null;
    }

    /**
     * Smooth scrolls to the target element specified by the selector.
     *
     * @param {string} selector - The CSS selector for the target element.
     * @param {Object} [options] - The options for smooth scrolling.
     * @param {string} [options.behavior='smooth'] - The scroll behavior.
     * @param {string} [options.block='start'] - The vertical alignment of the scroll target.
     * @param {string} [options.inline='nearest'] - The horizontal alignment of the scroll target.
     * @param {number} [options.offset=0] - The offset from the top of the target element.
     * @param {number} [options.speed=500] - The scroll animation speed in milliseconds.
     * @param {string} [options.easing='easeInOutQuad'] - The easing function for the scroll animation.
     */
    static smoothScroll(selector, options = {}) {
        const defaultOptions = {
            behavior: 'smooth',
            block: 'start',
            inline: 'nearest',
            offset: 0,
            speed: 500,
            easing: 'easeInOutQuad'
        };

        const scrollOptions = {
            ...defaultOptions,
            ...options
        };

        const easing = {
            linear: t => t,
            easeInQuad: t => t * t,
            easeOutQuad: t => t * (2 - t),
            easeInOutQuad: t => t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t
        };

        document.querySelectorAll(selector).forEach(item => {
            item.addEventListener('click', function (event) {
                const hash = this.getAttribute('href');
                const target = document.querySelector(hash);

                if (target) {
                    event.preventDefault();

                    const offsetTop = target.getBoundingClientRect().top + window.pageYOffset;
                    const startPosition = window.pageYOffset;
                    const distance = offsetTop - startPosition - scrollOptions.offset;
                    const duration = scrollOptions.speed;

                    let start = null;

                    window.requestAnimationFrame(step);

                    function step(timestamp) {
                        if (!start) start = timestamp;
                        const progress = timestamp - start;
                        const ease = easing[scrollOptions.easing](progress / duration);

                        window.scrollTo(0, startPosition + distance * ease);

                        if (progress < duration) {
                            window.requestAnimationFrame(step);
                        } else {
                            window.scrollTo({
                                top: offsetTop - scrollOptions.offset,
                                behavior: scrollOptions.behavior,
                                block: scrollOptions.block,
                                inline: scrollOptions.inline
                            });
                        }
                    }
                } else {
                    console.warn(`Target element not found for selector: ${hash}`);
                }
            });
        });
    }

    static generatePassword(password_length = 12, passwordElement) {
        const length = password_length;
        const charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$&?';
        const charsetLength = charset.length;
        let password = "";

        for (let i = 0; i < length; i++) {
            password += charset.charAt(Math.floor(Math.random() * charsetLength));
        }

        passwordElement.value = password;
    }

    static clearForm(formSelector) {
        const formElement = document.querySelector(formSelector);
        if (!formElement) {
            throw new Error(`No form found with the selector: ${formSelector}`);
        }
        formElement.querySelectorAll('input, textarea').forEach(el => {
            el.value = '';
            el.classList.remove('is-invalid');
        });
        formElement.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
    }


    static submitFormByAttribute() {
        const submitButtons = document.querySelectorAll('[form-submit]');
        submitButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const formName = this.getAttribute('form-submit');
                const form = document.querySelector(`[form-name="${formName}"]`);
                if (form) {
                    form.submit();
                } else {
                    console.error(`No form found with the name: ${formName}`);
                }
            });
        });
    }

    static closeModalWithButton(modalId, closeButton, callback) {
        const modal = document.querySelector(`#${modalId}`);
        let closeButtons = document.querySelectorAll(`${closeButton}`);
        closeButtons.forEach(closeBtn => {
            closeBtn.addEventListener('click', () => {
                const modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
                callback();
            });
        });
    }

    static closeModal(modalId, callback) {
        const modal = document.querySelector(`#${modalId}`);
        const modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
        callback();
    }

    static getLoadingModalContent() {
        return `
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Please wait...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    static getErrorModalContent() {
        return `
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>An error occurred while fetching application details. Please try again later.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    `;
    }
}

JS;
        $this->addCodeToFile($utilsJsFilePath, $code);
        $this->info('The utils.js file has been updated successfully.');
    }
}
