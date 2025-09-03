import { Translator } from "../../translation/translation.js";

const APP_VERSION = '1.7.4';                              // Default version for the application


const t = new Translator();
let url = window.location.href;
let baseUrl = url.split('/')[0] + '//' + url.split('/')[2];

/**
 * Configuration constants for the application.
 *
 * @constant {Object} __API_CFG__ - API configuration settings.
 * @property {string} CSRF_TOKEN_SELECTOR - Selector for the CSRF token meta tag.
 * @property {string} CSRF_TOKEN_HEADER - Header for the CSRF token.
 * @property {string} CSRF_TOKEN_ERROR - Error message for the CSRF token not found.
 * @property {string} BASE_URL - Base URL for API requests, dynamically includes the current locale.
 * @property {string} LOCAL_URL - Base local URL for development environment.
 * @property {number} REQUEST_TIMEOUT - Default timeout (in milliseconds) for HTTP requests.
 */

export const __API_CFG__ = {

    CSRF_TOKEN_SELECTOR: 'meta[name="csrf-token"]',       // Selector for the CSRF token meta tag
    CSRF_TOKEN_HEADER: 'X-CSRF-TOKEN',                    // Header for the CSRF token
    CSRF_TOKEN_ERROR: 'CSRF token not found',             // Error message for the CSRF token not found
    BASE_URL: `${baseUrl}/${t.currentLocale}`,            // Base URL for API requests, dynamically includes the current locale
    LOCAL_URL: `${baseUrl}`,                              // Base local URL for development environment
    REQUEST_TIMEOUT: 20000,                               // Default timeout (in milliseconds) for HTTP requests
}


/**
 * @constant {Object} __FORM_CFG__ - Form configuration settings.
 * @property {string} INVALID_FEEDBACK_CLASS - Class for the invalid feedback.
 * @property {string} INVALID_FIELD_CLASS - Class for the invalid field.
 * @property {number} PREVENT_MULTIPLE_SUBMISSION_TIMEOUT - Timeout (in milliseconds) for preventing multiple submissions.
 */
export const __FORM_CFG__ = {
    INVALID_FEEDBACK_CLASS: 'invalid-feedback fw-bold',   // Class for the invalid feedback
    INVALID_FIELD_CLASS: 'is-invalid',                    // Class for the invalid field
    PREVENT_MULTIPLE_SUBMISSION_TIMEOUT: 1000,            // Timeout (in milliseconds) for preventing multiple submissions
}


/**
 * @constant {Object} __GENERAL_CFG__ - General configuration settings.
 * @property {number} DEFAULT_RANDOM_STRING_LENGTH - Default length for generating random strings.
 * @property {number} DEBOUNCE_DELAY - Default delay (in milliseconds) for debouncing.
 * @property {number} THROTTLE_LIMIT - Default limit (in milliseconds) for throttling.
 */
export const __GENERAL_CFG__ = {

    DEFAULT_RANDOM_STRING_LENGTH: 8,                      // Default length for generating random strings
    DEBOUNCE_DELAY: 250,                                  // Default delay (in milliseconds) for debouncing
    THROTTLE_LIMIT: 500,                                  // Default limit (in milliseconds) for throttling
};


/**
 * @constant {Object} __LOADING_CFG__ - Loading button configuration settings.
 * @property {string} DEFAULT_LOADING_VERSION - Default version for the loading button.
 * @property {string} DEFAULT_LOADING_TEXT - Default text for the loading button.
 * @property {string} DEFAULT_LOADING_ATTRIBUTE - Default attribute for the loading button.
 * @property {string} DEFAULT_LOADING_SPINNER_ATTRIBUTE - Default spinner for the loading button.
 * @property {string} SHOW_SPINNER - Default show spinner for the loading button.
 */
export const __LOADING_CFG__ = {
    DEFAULT_LOADING_VERSION: "version_1",                // Default version for the loading button
    DEFAULT_LOADING_TEXT: "Please wait...",              // Default text for the loading button
    DEFAULT_LOADING_ATTRIBUTE: "loading",                // Default attribute for the loading button
    DEFAULT_LOADING_SPINNER_ATTRIBUTE: "with-spinner",   // Default spinner for the loading button
    SHOW_SPINNER: "true",                                // Default show spinner for the loading button
};

/**
 * @constant {string} APP_LANG - Default language for the application.
 */
export const APP_LANG = t.currentLocale;                 // Default language for the application


export const ENDPOINT = {

    AUTHENTICATION: {                                    // Authentication endpoints
        LOGIN: '/login',                                 // Login endpoint
        LOGOUT: '/logout',                               // Logout endpoint
        REGISTER: '/register',                           // Register endpoint
        FORGOT_PASSWORD: '/password/email',              // Forgot password endpoint
        RESET_PASSWORD: '/password/reset',               // Reset password endpoint
        VERIFY_EMAIL: '/email/resend',                   // Verify email endpoint
    }
}


/**
 * @constant {Object} __SWEET_ALERT_CFG__ - SweetAlert configuration settings.
 * @property {boolean} TIMER_PROGRESS_BAR - Default show progress bar for the timer.
 * @property {number} TIMER - Default timer for the SweetAlert.
 */
export const __SWEET_ALERT_CFG__ = {
    TIMER_PROGRESS_BAR: false,                           // Default show progress bar for the timer
    TIMER: 5000,                                        // Default timer for the SweetAlert
}

/**
 * @constant {Object} __DATA_TABLE_CFG__ - DataTable configuration settings.
 * @property {number} SEARCH_DELAY - Delay (in milliseconds) for the search input.
 * @property {boolean} PROCESSING - Enable or disable the processing indicator.
 * @property {boolean} SERVER_SIDE - Enable or disable server-side processing.
 * @property {Array<number>} LENGTH_MENU - Array of page length options.
 * @property {Array<string|number>} LENGTH_MENU_TEXT - Array of text for page length options.
 * @property {boolean} STATE_SAVE - Enable or disable state saving.
 * @property {boolean} ENABLE_SEARCH - Enable or disable the search functionality.
 * @property {boolean} ENABLE_FILTER - Enable or disable the filter functionality.
 * @property {boolean} ENABLE_RESET_FILTER - Enable or disable the reset filter functionality.
 * @property {boolean} ENABLE_COLUMN_VISIBILITY - Enable or disable column visibility control.
 * @property {boolean} ENABLE_TOGGLE_TOOLBAR - Enable or disable the toggle toolbar.
 * @property {boolean} ORDERABLE - Enable or disable ordering of columns.
 * @property {Object} ACTION_BUTTONS - Configuration for action buttons.
 * @property {boolean} ACTION_BUTTONS.edit - Enable or disable the edit button.
 * @property {boolean} ACTION_BUTTONS.delete - Enable or disable the delete button.
 * @property {boolean} ACTION_BUTTONS.view - Enable or disable the view button.
 */
export const __DATA_TABLE_CFG__ = {
    SEARCH_DELAY: 1500,                                  // Delay for the search input
    PROCESSING: true,                                    // Enable processing indicator
    SERVER_SIDE: true,                                   // Enable server-side processing
    LENGTH_MENU: [10, 20, 30, 40, 50, -1],               // Page length options
    LENGTH_MENU_TEXT: [10, 20, 30, 40, 50, 'All'],       // Text for page length options
    STATE_SAVE: false,                                   // Disable state saving

    ENABLE_SEARCH: false,                                 // Enable search functionality
    ENABLE_FILTER: false,                                 // Enable filter functionality
    ENABLE_RESET_FILTER: false,                           // Enable reset filter functionality
    ENABLE_COLUMN_VISIBILITY: false,                      // Enable column visibility control
    ENABLE_TOGGLE_TOOLBAR: false,                         // Enable toggle toolbar
    ORDERABLE: false,                                    // Disable ordering of columns
    ACTION_BUTTONS: {
        edit: true,                                      // Enable edit button
        delete: true,                                    // Enable delete button
        view: true,                                      // Enable view button
    }
}


/**
 * Updates the configuration object with new settings.
 * @param {Object} newConfig - The new configuration settings.
 * @example
 * // Update the configuration to change the debounce delay and throttle limit
 * updateConfig({ debounceDelay: 300, throttleLimit: 600 });
 */
export function updateConfig(newConfig) {
    Object.assign(config, newConfig);
}
