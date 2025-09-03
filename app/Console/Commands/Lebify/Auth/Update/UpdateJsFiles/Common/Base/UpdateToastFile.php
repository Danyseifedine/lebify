<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateToastFile extends Command
{
    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:toast-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the toast.js file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $toastJsFilePath = public_path('js/common/base/messages/toast.js');

        $code = <<<'JS'
import { APP_LANG } from "../config/config.js";
import { FunctionUtility } from "../utils/utils.js";

/**
 * Class for displaying toast notifications using the iziToast library.
 */
export class Toast {

    /**
     * Shows a success toast notification.
     * @param {string} title - The title of the toast.
     * @param {string} message - The message of the toast.
     * @param {Object} [options={}] - Additional options for the toast.
     */
    static showSuccessToast(title, message, currentLocale = APP_LANG, options = {}) {
        const defaultOptions = {
            theme: "dark",
            backgroundColor: "#2e8b57",
            iconColor: "white",
            titleColor: "white",
            messageColor: "white",
            icon: "bi bi-check-all",
            position: "topRight",
            timeout: 5000,
            progressBar: true,
            progressBarColor: "#1b5e38",
            closeOnClick: true,
            pauseOnHover: true,
            resetOnHover: false,
            transitionIn: "fadeInLeft",
            transitionOut: "fadeOutRight",
            zindex: 99999,
            rtl: currentLocale == "ar" ? true : false,
        };

        const mergedOptions = { ...defaultOptions, ...options };

        iziToast.success({
            title: title,
            message: message,
            ...mergedOptions,
        });
    }


    /**
     * Shows a warning toast notification.
     * @param {string} title - The title of the toast.
     * @param {string} message - The message of the toast.
     * @param {Object} [options={}] - Additional options for the toast.
     */
    static showWarningToast(title, message, currentLocale = APP_LANG, options = {}) {
        const defaultOptions = {
            theme: "dark",
            backgroundColor: "#ffa500",
            iconColor: "white",
            titleColor: "white",
            messageColor: "white",
            icon: "bi bi-exclamation-triangle",
            position: "topRight",
            timeout: 10000,
            progressBar: true,
            progressBarColor: "#b37700",
            closeOnClick: true,
            pauseOnHover: true,
            resetOnHover: false,
            transitionIn: "fadeInLeft",
            transitionOut: "fadeOutRight",
            zindex: 99999,
            rtl: currentLocale == "ar" ? true : false,
        };

        const mergedOptions = { ...defaultOptions, ...options };

        iziToast.warning({
            title: title,
            message: message,
            ...mergedOptions,
        });
    }


    /**
     * Shows an info toast notification.
     * @param {string} title - The title of the toast.
     * @param {string} message - The message of the toast.
     * @param {Object} [options={}] - Additional options for the toast.
     */
    static showInfoToast(title, message, currentLocale = APP_LANG, options = {}) {
        const defaultOptions = {
            theme: "dark",
            backgroundColor: "#17a2b8",
            icon: "bi bi-info",
            iconColor: "white",
            messageColor: "white",
            titleColor: "white",
            position: "topRight",
            timeout: 5000,
            progressBar: true,
            progressBarColor: "#117a8b",
            closeOnClick: true,
            pauseOnHover: true,
            resetOnHover: false,
            transitionIn: "fadeInLeft",
            transitionOut: "fadeOutRight",
            zindex: 99999,
            rtl: currentLocale == "ar" ? true : false,
        };

        const mergedOptions = { ...defaultOptions, ...options };

        iziToast.info({
            title: title,
            message: message,
            ...mergedOptions,
        });
    }


    /**
     * Shows an error toast notification.
     * @param {string} title - The title of the toast.
     * @param {string} message - The message of the toast.
     * @param {Object} [options={}] - Additional options for the toast.
     */
    static showErrorToast(title, message, currentLocale = APP_LANG, options = {}) {
        const defaultOptions = {
            theme: "dark",
            position: "topRight",
            timeout: 10000,
            progressBar: true,
            closeOnClick: false,
            pauseOnHover: true,
            resetOnHover: false,
            transitionIn: "fadeInLeft",
            transitionOut: "fadeOutRight",
            icon: "ri-error-warning-line",
            backgroundColor: "#dc3545",
            titleColor: "white",
            messageColor: "white",
            iconColor: "white",
            progressBarColor: "#a71d2a",
            zindex: 99999,
            rtl: currentLocale == "ar" ? true : false,
        };

        const mergedOptions = { ...defaultOptions, ...options };

        iziToast.error({
            title: title,
            message: message,
            ...mergedOptions,
        });
    }


    /**
     * Shows a confirmation toast notification with confirm and cancel buttons.
     * @param {string} title - The title of the toast.
     * @param {string} message - The message of the toast.
     * @param {Function} confirmCallback - The callback function to be executed when the confirm button is clicked.
     * @param {Object} [options={}] - Additional options for the toast.
     */

    static showConfirmationToast(title, message, currentLocale = APP_LANG, confirmCallback, options = {}) {
        const defaultOptions = {
            theme: "dark",
            position: "center",
            timeout: false,
            progressBar: false,
            closeOnClick: false,
            pauseOnHover: true,
            resetOnHover: false,
            transitionIn: "fadeInLeft",
            transitionOut: "fadeOutRight",
            buttons: [
                ["<button>Confirm</button>", confirmCallback, true],
                ["<button>Cancel</button>", function (instance, toast) {
                    instance.hide({ transitionOut: "fadeOutUp" }, toast, "buttonName");
                }],
            ],
            zindex: 99999,
            rtl: currentLocale == "ar" ? true : false,
        };

        const mergedOptions = { ...defaultOptions, ...options };

        iziToast.question({
            title: title,
            message: message,
            ...mergedOptions,
        });
    }


    /**
     * Shows a loading toast notification.
     * @param {string} message - The message of the toast.
     * @param {Object} [options={}] - Additional options for the toast.
     */
    static showLoadingToast(message, currentLocale = APP_LANG, options = {}) {
        const defaultOptions = {
            position: "center",
            timeout: false,
            progressBar: false,
            closeOnClick: false,
            pauseOnHover: true,
            resetOnHover: false,
            transitionIn: "fadeInLeft",
            transitionOut: "fadeOutRight",
            overlay: true,
            overlayClose: false,
            displayMode: "once",
            zindex: 99999,
            rtl: currentLocale == "ar" ? true : false,
        };

        const mergedOptions = { ...defaultOptions, ...options };

        iziToast.show({
            message: message,
            ...mergedOptions,
        });
    }


    /**
     * Hides the loading toast notification.
     */
    static hideLoadingToast() {
        const loadingToastElement = document.querySelector('.iziToast');
        if (loadingToastElement) {
            iziToast.hide({}, loadingToastElement, "overlay");
        }
    }

    /**
     * Shows a custom toast notification with the provided options.
     * @param {Object} options - The options for the toast.
     */
    static showCustomToast(options) {
        iziToast.show(options);
    }

    /**
     * Hides a toast notification by its ID.
     * @param {string} id - The ID of the toast to be hidden.
     */
    static hideToastById(id) {
        iziToast.hide('#' + id);
    }


    /**
     * Hides a toast notification by its reference.
     * @param {Object} ref - The reference of the toast to be hidden.
     */
    static hideToastByRef(ref) {
        iziToast.hide({}, ref);
    }


    /**
     * Hides all toast notifications.
     */

    static hideAllToasts() {
        iziToast.hide({}, false, true);
    }


    /**
     * Shows a notification toast.
     * @param {string} title - The title of the toast.
     * @param {string} message - The message of the toast.
     * @param {Object} [options={}] - Additional options for the toast.
     */
    static showNotificationToast(title, message, currentLocale = APP_LANG, options = {}) {
        const defaultOptions = {
            theme: "dark",
            backgroundColor: "#343a40",
            titleColor: "white",
            messageColor: "white",
            position: "topRight",
            timeout: 5000,
            progressBar: true,
            progressBarColor: "#212529",
            closeOnClick: true,
            pauseOnHover: true,
            resetOnHover: false,
            transitionIn: "fadeInLeft",
            transitionOut: "fadeOutRight",
            zindex: 99999,
            rtl: currentLocale == "ar" ? true : false,
        };

        const mergedOptions = { ...defaultOptions, ...options };

        iziToast.show({
            title: title,
            message: message,
            ...mergedOptions,
        });
    }


    /**
     * Shows a toast with HTML content.
     * @param {string} title - The title of the toast.
     * @param {string} content - The HTML content of the toast.
     * @param {Object} [options={}] - Additional options for the toast.
     */
    static showToastWithHTML(title, content, currentLocale = APP_LANG, options = {}) {
        const defaultOptions = {
            position: "topRight",
            timeout: 10000,
            progressBar: true,
            closeOnClick: true,
            pauseOnHover: true,
            resetOnHover: false,
            transitionIn: "fadeInLeft",
            transitionOut: "fadeOutRight",
            zindex: 99999,
            rtl: currentLocale == "ar" ? true : false,
        };

        const mergedOptions = { ...defaultOptions, ...options };

        iziToast.show({
            title: title,
            message: content,
            ...mergedOptions,
        });
    }

    /**
     * Shows a toast with an image.
     * @param {string} title - The title of the toast.
     * @param {string} message - The message of the toast.
     * @param {string} imageUrl - The URL of the image to be displayed in the toast.
     * @param {Object} [options={}] - Additional options for the toast.
     */
    static showToastWithImage(title, message, currentLocale = APP_LANG, imageUrl, options = {}) {
        const defaultOptions = {
            position: "topRight",
            timeout: 10000,
            progressBar: true,
            closeOnClick: true,
            pauseOnHover: true,
            resetOnHover: false,
            transitionIn: "fadeInLeft",
            transitionOut: "fadeOutRight",
            image: imageUrl,
            imageWidth: 100,
            zindex: 99999,
            rtl: currentLocale == "ar" ? true : false,
        };

        const mergedOptions = { ...defaultOptions, ...options };

        iziToast.show({
            title: title,
            message: message,
            ...mergedOptions,
        });
    }

    /**
    * Handles the display of a success toast based on a query parameter and local storage.
    * @param {string} successParam - The name of the query parameter to check for success.
    * @param {string} toastTitleKey - The key for the toast title translation.
    * @param {string} toastMessageKey - The key for the toast message translation.
    * @param {string} storageKey - The key for storing the success state in the local storage.
    */
    static handleSuccessToastWithStorage(successParam, toastTitleKey, toastMessageKey, storageKey, currentLocale = APP_LANG) {
        const success = FunctionUtility.getQueryParameter(successParam);
        const successShown = localStorage.getItem(storageKey);

        if (success && !successShown) {
            Toast.showSuccessToast(
                toastTitleKey,
                toastMessageKey,
                {
                    rtl: currentLocale == "ar" ? true : false,
                }
            );
            localStorage.setItem(storageKey, true);
        }
    }
}
JS;

        $this->addCodeToFile($toastJsFilePath, $code);
        $this->info('The toast.js file has been updated successfully.');
    }
}
