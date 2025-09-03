<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Core;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateControllersCommonFile extends Command
{
    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:controllers-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the controllers.js file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $authPath = public_path('js/common/Core/controllers.js');

        $code = <<<'JS'
import { FormHandler } from '../base/formHandler/formHandler.js';
import { ErrorHandler } from '../base/error/error.js';
import { HttpRequest } from '../base/api/request.js';
import { ButtonLoadingState } from '../base/loadingButton/loadingButton.js';
import { __API_CFG__, __DATA_TABLE_CFG__ } from '../base/config/config.js';
import { SweetAlert } from '../base/messages/sweetAlert.js';
import { FunctionUtility } from '../base/utils/utils.js';


/**
 * Class to handle form submission and processing.
 * @param {Object} config - Configuration object for the form controller.
 * @param {string} config.formSelector - The selector for the form element.
 * @param {string} config.buttonSelector - The selector for the submit button element.
 * @param {string} config.loadingTemplate - The HTML template to display while loading. There are 11 default button loading templates available. You can choose a version by setting loadingTemplate to "version_1" through "version_11". Alternatively, you can provide a custom loading template using onLoading and onLoad callbacks.
 * @param {string} config.endpoint - The URL to which the form data will be submitted.
 * @param {function} [config.onLoading] - Callback function to handle loading state.
 * @param {function} [config.onSuccess] - Callback function to handle successful form submission.
 * @param {function} [config.onError] - Callback function to handle errors during form submission.
 * @param {function} [config.onLoaded] - Callback function to handle post-loading state.
 * @param {boolean} [config.feedback] - Flag to indicate if validation feedback should be handled.
 *
 *
 * @example
 * const sendEmailConfig = {
 *     formSelector: '#send-email-form',
 *     buttonSelector: '#send-email-form button[type="submit"]',
 *     loadingTemplate: 'version_1', // or any version from "version_1" to "version_11"
 *     endpoint: `${__API_URL__.BASE_URL}/dashboard/tab`,
 *
 *      // You can also provide custom loading and post-loading callbacks
 *      // (overrides the default loadingTemplate)
 *     onLoading: (btn) => { btn.disabled = true; },
 *
 *     onSuccess: (res) => { console.log('Email sent successfully!', res); },
 *     onError: (err) => { console.error('Error sending email', err); },
 *
 *     // You can also provide custom load and post-loading callbacks
 *     // (overrides the default loadingTemplate)
 *     onLoad: (btn) => { btn.disabled = false; },
 *     feedback: true,
 * };
 *
 * const sendEmail = new $SingleFormPostController(sendEmailConfig);
 * sendEmail.init();
 */
export class $SingleFormPostController {
    constructor(config) {
        this.config = config;
        this.form = document.querySelector(config.formSelector);
        this.submitBtn = document.querySelector(config.buttonSelector);
        this.externalBtn = document.querySelector(config.externalButtonSelector);
    }

    /**
    * Process the form data asynchronously.
    * @param {FormData} formData - The form data to be processed.
    */
    async processForm(formData) {
        const activeBtn = this.submitBtn || this.externalBtn;
        const buttonLoadingState = new ButtonLoadingState(activeBtn, this.config.loadingTemplate);

        // Check for onLoading callback
        if (this.config.onLoading) {
            this.config.onLoading(activeBtn);
        } else {
            buttonLoadingState.activate();
        }

        try {
            const res = await HttpRequest.post(this.config.endpoint, formData);
            FormHandler.clearValidationFeedback(this.form);
            if (this.config.onSuccess) {
                this.config.onSuccess(res);
            }

        } catch (error) {
            if (this.config.feedback) {
                if (error.response && error.response.status === 422) {
                    FormHandler.clearValidationFeedback(this.form);
                    ErrorHandler.handleValidationError(error.response.data.errors, this.form);
                }
            }
            if (this.config.onError) {
                this.config.onError(error);
            }
        } finally {
            // Check for onLoad callback
            if (this.config.onLoaded) {
                this.config.onLoaded(activeBtn);
            } else {
                buttonLoadingState.reset();
            }
        }
    }

    /**
     * Initializes the form by adding listeners to both the form and external button.
     */
    init() {
        if (this.form) {
            FormHandler.formListener(this.form, (formData) => this.processForm(formData));
        }

        if (this.externalBtn) {
            this.externalBtn.addEventListener('click', (event) => {
                event.preventDefault();
                if (this.form) {
                    const formData = new FormData(this.form);
                    this.processForm(formData);
                } else {
                    console.error(`Form with selector ${this.config.formSelector} not found`);
                }
            });
        }
    }

    static initDropzone(dropzoneId, uploadUrl, maxFiles = 1, maxFilesize = 10, acceptedFiles = ".pdf", success) {
        // Get the CSRF token from the meta tag
        var token = document.querySelector(__API_CFG__.CSRF_TOKEN_SELECTOR).getAttribute('content');

        return new Dropzone(dropzoneId, {
            autoDiscover: false,
            url: uploadUrl,
            paramName: "file",
            maxFiles: maxFiles,
            headers: {
                'X-CSRF-TOKEN': token
            },
            maxFilesize: maxFilesize,
            addRemoveLinks: true,
            acceptedFiles: acceptedFiles,
            accept: function (file, done) {
                if (file.name == "wow.pdf") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            },
            success: success
        });
    }
}

/**
 * Constructor for GetTabController.
 * @param {Object} config - Configuration object for the tab controller.
 * @param {string} config.TabSelector - The class name for the tab elements.
 * @param {string} config.LoadingHtml - The HTML to display while loading tab content.
 * @param {string} config.ActiveTabSelector - The class name for the active tab element.
 * @param {string} config.TabContentSelector - The class name for the tab content container.
 * @param {string} config.endpoint - The base URL for fetching tab data.
 * @param {function} config.onSuccess - Callback function to handle successful data retrieval.
 * @param {function} config.onError - Callback function to handle errors during data retrieval.
 *
 * @example
 * // Example usage:
 * const tabConfig = {
 *     TabSelector: '.tab-nav',
 *     LoadingHtml: '<div>Please wait...</div>',
 *     ActiveTabSelector: '.tab-nav.active',
 *     TabContentSelector: '.tab-content',
 *     endpoint: `${__API_URL__.BASE_URL}/dashboard/tab`,
 *     onSuccess: function (data) {
 *         console.log(data);
 *         document.querySelector('.tab-content').innerHTML = data.html;
 *     },
 *     onError: function (data) {
 *         console.log(data);
 *     },
 * };
 * const tabController = new GetTabController(tabConfig);
 * tabController.initTab();
 */
export class $GetTabController {
    constructor(config) {
        this.config = config;
        this.activeTab = null;
    }

    initTab() {
        this.attachTabListeners();
        this.syncActiveTabWithUrl();
    }

    attachTabListeners() {
        const tabs = document.querySelectorAll(this.config.TabSelector);
        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                this.switchTab(tab);
            });
        });
    }

    syncActiveTabWithUrl() {
        const urlTab = this.getTabFromUrl();
        let tabToActivate;

        if (urlTab) {
            tabToActivate = document.querySelector(`${this.config.TabSelector}[tab-name="${urlTab}"]`);
        }

        if (!tabToActivate) {
            tabToActivate = document.querySelector(this.config.ActiveTabSelector);
        }

        // Remove 'active' class from all tabs
        document.querySelectorAll(this.config.TabSelector).forEach(tab => {
            tab.classList.remove('active');
        });

        if (tabToActivate) {
            tabToActivate.classList.add('active');
            this.activeTab = tabToActivate;
            this.fetchTabContent(tabToActivate.getAttribute('tab-name'));
        } else {
            // If no tab to activate, activate the first tab
            const firstTab = document.querySelector(this.config.TabSelector);
            if (firstTab) {
                this.switchTab(firstTab, true);
            }
        }
    }

    switchTab(tab, updateUrl = true) {
        const tabName = tab.getAttribute('tab-name');
        if (this.activeTab) {
            this.activeTab.classList.remove('active');
        }
        tab.classList.add('active');
        this.activeTab = tab;

        this.fetchTabContent(tabName);

        if (updateUrl && this.config.updateUrl) {
            this.updateUrlWithTab(tabName);
        }
    }

    async fetchTabContent(tabName) {
        const tabContent = document.querySelector(this.config.TabContentSelector);

        if (this.config.onLoading) {
            this.config.onLoading();
        }

        tabContent.innerHTML = this.config.LoadingHtml;
        const url = `${this.config.endpoint}/${tabName}`;

        try {
            const response = await this.httpGet(url);
            if (this.config.onSuccess) {
                this.config.onSuccess(response);
            }
        } catch (error) {
            console.error('Failed to fetch tab content:', error);
            if (this.config.onError) {
                this.config.onError(error);
            }
        } finally {
            if (this.config.onLoad) {
                this.config.onLoad();
            }
        }
    }

    updateUrlWithTab(tabName) {
        const url = new URL(window.location);
        url.searchParams.set('tab', tabName);
        window.history.pushState({}, '', url);
    }

    getTabFromUrl() {
        const url = new URL(window.location);
        return url.searchParams.get('tab');
    }

    async httpGet(url) {
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    }

    static observeTabChanges(options) {
        const { tabCallbacks, elementSelector, tabSelector } = options;

        const executeCallbacks = (tabName) => {
            if (tabCallbacks && tabCallbacks[tabName]) {
                let hasExecuted = false;
                let observer = new MutationObserver((mutations, obs) => {
                    const targetElement = elementSelector ? document.querySelector(elementSelector) : document.documentElement;
                    if (targetElement) {
                        const checkElement = () => {
                            if (document.querySelector('.card-toolbar') && !hasExecuted) {
                                hasExecuted = true;
                                tabCallbacks[tabName].forEach(callback => callback());
                                obs.disconnect();
                            } else if (!hasExecuted) {
                                requestAnimationFrame(checkElement);
                            }
                        };
                        checkElement();
                    }
                });
                observer.observe(document.body, {
                    childList: true,
                    subtree: true
                });
            }
        };

        document.querySelectorAll(tabSelector).forEach(tab => {
            tab.addEventListener('click', function () {
                const currentTabName = this.getAttribute('tab-name');
                executeCallbacks(currentTabName);
            });
        });

        const activeTab = document.querySelector(`${tabSelector}.active`);
        if (activeTab) {
            const activeTabName = activeTab.getAttribute('tab-name');
            executeCallbacks(activeTabName);
        }
    }
}

/**
 * $DeleteFormsController is responsible for handling the deletion of forms.
 * It initializes forms, attaches event listeners, and manages the deletion process.
 *
 * @class
 * @param {Object} config - Configuration options for the delete forms controller.
 * @param {string} config.formSelector - Selector for the forms to be initialized.
 * @param {string} config.dataAttribute - Data attribute to get the ID of the item to be deleted.
 * @param {string} config.buttonSelector - Selector for the submit button within the form.
 * @param {string} config.endpoint - API endpoint for the delete request.
 * @param {function} [config.onSuccess] - Callback function to be executed on successful deletion.
 * @param {function} [config.onError] - Callback function to be executed on deletion error.
 * @param {function} [config.onLoading] - Callback function to be executed while the delete request is in progress.
 * @param {function} [config.onLoaded] - Callback function to be executed after the delete request is completed.
 * @param {string} [config.loadingTemplate] - Template for the loading state of the button.
 *
 * @example
 * const deleteFormConfig = {
 *     formSelector: '#delete-product-form',
 *     dataAttribute: 'data-delete-product-id',
 *     buttonSelector: '#delete-product-form button[type="submit"]',
 *     endpoint: '/api/delete-product',
 *     onSuccess: (response, form, id) => {
 *         console.log('Deleted successfully:', id);
 *     },
 *     onError: (error, form, id) => {
 *         console.error('Deletion error:', error);
 *     }
 * };
 * const deleteFormsController = new $DeleteFormsController(deleteFormConfig);
 * deleteFormsController.initForms();
 */
export class $DeleteFormsController {

    constructor(config) {
        this.config = config;
    }

    initForms() {
        const forms = document.querySelectorAll(this.config.formSelector);
        forms.forEach(form => {
            if (form.dataset.listenerAttached) return;

            const handler = async (event) => {

                event.preventDefault();
                const dataId = form.getAttribute(this.config.dataAttribute);
                await this.deleteData(dataId, form);
            };

            form.addEventListener('submit', handler);
            form.dataset.listenerAttached = 'true';
        });
    }

    async deleteData(dataId, form) {
        const button = form.querySelector(this.config.buttonSelector);
        const buttonLoadingState = new ButtonLoadingState(button, this.config.loadingTemplate);
        if (this.config.onLoading) {
            this.config.onLoading(button);
        } else {
            buttonLoadingState.activate();
        }
        try {
            const response = await HttpRequest.del(`${this.config.endpoint}/${dataId}`);
            if (this.config.onSuccess) {
                this.config.onSuccess(response, form, dataId);
            }
        } catch (error) {
            if (this.config.onError) {
                this.config.onError(error, form, dataId);
            }
        } finally {
            // Check for onLoad callback
            if (this.config.onLoaded) {
                this.config.onLoaded(button);
            } else {
                buttonLoadingState.reset();
            }
        }
    }
}

/**
 * MultiFormsPostController is responsible for handling multiple forms.
 * It initializes forms, attaches event listeners, and manages the update process.
 *
 * @class
 * @param {Object} config - The configuration object for the controller.
 * @param {string} config.formSelector - The CSS selector for the forms to be managed.
 * @param {string} config.dataAttribute - The data attribute to retrieve the form's data ID.
 * @param {string} config.buttonSelector - The CSS selector for the submit button within the form.
 * @param {Function} [config.onLoading] - Optional callback function to be called when the form is loading.
 * @param {Function} [config.onSuccess] - Optional callback function to be called when the form is successfully submitted.
 * @param {Function} [config.onError] - Optional callback function to be called when there is an error during form submission.
 * @param {Function} [config.onLoaded] - Optional callback function to be called when the form loading is complete.
 * @param {string} [config.loadingTemplate] - Optional template for the loading state of the submit button.
 * @param {boolean} [config.enableFeedback] - Optional flag to enable or disable feedback during form submission.
 *
 * @example
 * const EditPostConfig = {
 *     formSelector: '#update-product-form',
 *     dataAttribute: 'data-update-product-id',
 *     buttonSelector: '#update-product-form button[type="submit"]',
 *     enableFeedback: false,
 *     apiUrl: `${__API_CFG__.BASE_URL}/dashboard/products/update`,
 *     onSuccess: (response, form, id) => {
 *         FunctionUtility.hideModal(`edit-product-form-${id}`);
 *         Toast.showSuccessToast('', response.message);
 *     },
 *     onError: (error) => {
 *         console.log(error)
 *     }
 * }
 * const editFormController = new UpdateFormController(EditPostConfig);
 * editFormController.initForms();
 */
export class $MultiFormsPostController {

    constructor(config) {
        this.config = config;
    }

    initForms() {
        const forms = document.querySelectorAll(this.config.formSelector);
        forms.forEach(form => {
            // Check if the event listener has already been attached
            if (form.dataset.listenerAttached) return;

            const handler = async (event) => {
                event.preventDefault(); // Prevent form from submitting traditionally
                const dataId = form.getAttribute(this.config.dataAttribute);
                await this.updateData(dataId, form);
            };

            form.addEventListener('submit', handler);
            form.dataset.listenerAttached = 'true'; // Mark this form as having an event listener attached
        });
    }

    initForm() {
        const form = document.querySelector(this.config.formSelector);
        if (form) {
            FormHandler.formListener(form, async () => {
                const dataId = form.getAttribute(this.config.dataAttribute);
                await this.updateData(dataId, form);
            });
        }
    }

    async updateData(dataId, form) {
        const button = form.querySelector(this.config.buttonSelector);
        const buttonLoadingState = new ButtonLoadingState(button, this.config.loadingTemplate);

        if (this.config.onLoading) {
            this.config.onLoading(button);
        } else {
            buttonLoadingState.activate();
        }
        let formData = new FormData(form);

        try {
            // Directly pass formData to the request
            const response = await HttpRequest.post(`${this.config.endpoint}/${dataId}`, formData);
            if (this.config.onSuccess) {
                this.config.onSuccess(response, form, dataId);
            }
        } catch (error) {
            if (this.config.onError) {
                if (error.response.status === 422) {
                    FormHandler.clearValidationFeedback(this.config.formSelector);
                    ErrorHandler.handleValidationError(error.response.data.errors);
                }
                this.config.onError(error, form, dataId);
            }
        } finally {
            if (this.config.onLoaded) {
                this.config.onLoaded(button);
            } else {
                buttonLoadingState.reset();
            }
        }
    }
}

/**
 * GetDataWhileScrollingController is responsible for handling the infinite scrolling functionality.
 * It initializes the intersection observer, debounces the fetchData function, and manages the cache.
 *
 * @class
 * @param {Object} config - The configuration object for the controller.
 * @param {string} config.endpoint - The route to fetch data from.
 * @param {number} [config.scrollHeight] - The height at which to trigger data fetching.
 * @param {number} [config.debounceDelay] - The delay for debouncing the fetchData function.
 * @param {number} [config.initialPage] - The initial page number to fetch.
 * @param {number} [config.pageSize] - The number of items to fetch per page.
 * @param {number} [config.maxRetries] - The maximum number of retries in case of network errors.
 * @param {number} [config.retryDelay] - The delay between retries.
 * @param {Function} [config.onSuccess] - Optional callback function to be called on successful data fetching.
 * @param {Function} [config.onError] - Optional callback function to be called on error.
 * @param {Function} [config.onLoading] - Optional callback function to be called when the form is loading.
 * @param {Function} [config.onLoaded] - Optional callback function to be called when the form loading is complete.
 * @param {Object} [config.params] - Optional parameters to be passed to the fetchData function.
 * @param {Object} [config.headers] - Optional headers to be passed to the fetchData function.
 *
 * @example
 * const PostConfig = {
 *  endpoint: `${__API_CFG__.BASE_URL}/dashboard/products/scroll`,
 *  scrollHeight: 500,
 *  params: {},
 *  headers: {},
 *  debounceDelay: 1000,
 *  onSuccess: (res) => {
 *      console.log(res);
 *      const container = document.getElementById('post-container');
 *
 *      res.forEach(post => {
 *           container.insertAdjacentHTML('beforeend', post.html);
 *       });
 *       initDeletePostForm();
 *       initEditPostForm();
 *   },
 *   onError: (res) => {
 *       console.error(res);
 *   },
 *   onLoading: () => {
 *       const container = document.getElementById('post-container');
 *       if (!container.querySelector('.loading-indicator')) {
 *           container.insertAdjacentHTML('beforeend', '<div class="loading-indicator">khaled...</div>');
 *       }
 *   },
 *   onLoaded: () => {
 *       const loadingIndicator = document.querySelector('.loading-indicator');
 *       if (loadingIndicator) {
 *           loadingIndicator.remove();
 *       }
 *   }
 *};
 *
 * new GetDataWhileScrollingController(PostConfig);
 */
export class $InfiniteLoaderController {
    constructor(config) {
        this.config = {
            endpoint: config.endpoint,
            scrollHeight: config.scrollHeight || 500,
            debounceDelay: config.debounceDelay || 200,
            initialPage: config.initialPage || 1,
            pageSize: config.pageSize || 20,
            maxRetries: config.maxRetries || 3,
            retryDelay: config.retryDelay || 1000,
            onSuccess: config.onSuccess || (() => { }),
            onError: config.onError || console.error,
            onLoading: config.onLoading || (() => { }),
            onLoaded: config.onLoaded || (() => { }),
            params: config.params || {},
            headers: config.headers || {},
            onDestroy: config.onDestroy || (() => { })
        };
        this.isLoading = false;
        this.hasMorePages = true;
        this.currentPage = this.config.initialPage;
        this.lastScrollTop = 0;
        this.debounceTimer = null;
        this.retryCount = 0;
        this.cache = new Map();
        this.intersectionObserver = null;
        this.initIntersectionObserver();
    }

    initIntersectionObserver() {
        const options = {
            root: null,
            rootMargin: `${this.config.scrollHeight}px`,
            threshold: 0
        };

        this.intersectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !this.isLoading && this.hasMorePages) {
                    this.debouncedFetchData();
                }
            });
        }, options);

        const sentinel = document.createElement('div');
        sentinel.id = 'scroll-sentinel';
        document.body.appendChild(sentinel);
        this.intersectionObserver.observe(sentinel);
    }

    debouncedFetchData() {
        this.config.onLoading();
        if (this.debounceTimer) {
            clearTimeout(this.debounceTimer);
        }
        this.debounceTimer = setTimeout(() => {
            this.fetchData();
        }, this.config.debounceDelay);
    }

    async fetchData() {
        if (this.isLoading) return;
        this.isLoading = true;

        try {
            const cachedData = this.cache.get(this.currentPage);
            if (cachedData) {
                this.processData(cachedData);
                return;
            }

            const url = new URL(this.config.endpoint);
            url.searchParams.append('page', this.currentPage);
            url.searchParams.append('pageSize', this.config.pageSize);
            url.searchParams.append('perPage', this.config.perPage); // Added perPage parameter
            Object.entries(this.config.params).forEach(([key, value]) => {
                url.searchParams.append(key, value);
            });

            const response = await this.fetchWithRetry(() =>
                fetch(url, { headers: this.config.headers })
            );
            const data = await response.json();

            this.cache.set(this.currentPage, data);
            this.processData(data);
        } catch (error) {
            this.config.onError(error);
        } finally {
            this.isLoading = false;
            this.config.onLoaded();
        }
    }

    async fetchWithRetry(fetchFunction, retryCount = 0) {
        try {
            return await fetchFunction();
        } catch (error) {
            if (retryCount < this.config.maxRetries) {
                await new Promise(resolve => setTimeout(resolve, this.config.retryDelay));
                return this.fetchWithRetry(fetchFunction, retryCount + 1);
            }
            throw error;
        }
    }

    processData(data) {
        if (!data || data.empty || (Array.isArray(data) && data.length === 0)) {
            this.hasMorePages = false;
            this.destroy();
        } else {
            this.config.onSuccess(data);
            this.currentPage++;
        }
    }

    reset() {
        this.currentPage = this.config.initialPage;
        this.hasMorePages = true;
        this.isLoading = false;
        this.cache.clear();
        if (this.debounceTimer) {
            clearTimeout(this.debounceTimer);
        }
    }

    destroy() {
        if (this.intersectionObserver) {
            this.intersectionObserver.disconnect();
        }
        const sentinel = document.getElementById('scroll-sentinel');
        if (sentinel) {
            sentinel.remove();
        }
        this.cache.clear();
        if (this.debounceTimer) {
            clearTimeout(this.debounceTimer);
        }
        this.isLoading = false;
        this.hasMorePages = false;
        this.currentPage = this.config.initialPage;
        this.lastScrollTop = 0;
        this.retryCount = 0;

        if (typeof this.config.onDestroy === 'function') {
            this.config.onDestroy();
        }
    }
}

/**
 * IconToggleFormController is a class that handles the toggling of icons within forms
 * and updating the associated data on the server.
 *
 * @param {Object} config - Configuration object for the controller
 * @param {string} config.formSelector - CSS selector for the forms to be handled
 * @param {string} config.dataAttribute - Data attribute to identify the form
 * @param {string} config.endpoint - API endpoint to send the form data
 * @param {string} config.iconSelector - CSS selector for the icon to be toggled
 * @param {string} [config.beforeClickIcon] - CSS class for the icon before it is clicked
 * @param {string} [config.afterClickIcon] - CSS class for the icon after it is clicked
 * @param {boolean} [config.increaseCount] - Whether to increase the count on icon click
 * @param {string} [config.countSelector] - CSS class for the count element
 * @param {Function} [config.beforeSubmit] - Function to be called before form submission
 *
 * Example usage:
 *
 * @example
 * const likeFormController = new IconToggleFormController({
 *     formSelector: '.like-product-form',
 *     dataAttribute: 'data-like-product-id',
 *     endpoint: 'https://example.com/api/like',
 *     iconSelector: 'i',
 *     beforeClickIcon: 'bi-heart',
 *     afterClickIcon: 'bi-heart-fill',
 *     //toggleClass: 'liked',
 *     increaseCount: true,
 *     countSelector: 'like-count',
 *     beforeSubmit: (form, dataId) => {
 *         console.log(`Submitting form for product ID: ${dataId}`);
 *     }
 * });
 *
 * likeFormController.initForms();
 *
 */
export class $IconStateController {

    constructor(config) {
        this.validateConfig(config);
        this.config = config;
        this.config.countChangeAmount = this.config.countChangeAmount || 1;
    }

    validateConfig(config) {
        const requiredFields = ['formSelector', 'dataAttribute', 'endpoint', 'iconSelector'];
        requiredFields.forEach(field => {
            if (!config[field]) {
                throw new Error(`Missing required configuration field: ${field}`);
            }
        });
    }

    initForms() {
        const forms = document.querySelectorAll(this.config.formSelector);
        forms.forEach(form => {
            if (form.dataset.listenerAttached) return;

            const handler = async (event) => {
                event.preventDefault();
                await this.handleSubmit(event, form);
            };

            form.addEventListener('submit', handler);
            form.dataset.listenerAttached = 'true';
        });
    }

    async handleSubmit(event, form) {
        const dataId = form.getAttribute(this.config.dataAttribute);

        try {
            if (this.config.beforeSubmit) {
                this.config.beforeSubmit(form, dataId);
            }

            this.toggleIcon(form);

            if (this.config.increaseCount) {
                this.updateCount(dataId, form);
            }

            await this.updateData(dataId, form);
        } catch (error) {
            console.error("Error in handleSubmit:", error);
            if (this.config.onError) {
                this.config.onError(error, form, dataId);
            }
        }
    }

    updateCount(dataId, form) {
        if (!this.config.countSelector) return;

        const countElement = document.querySelector(`.${this.config.countSelector}-${dataId}`);
        if (!countElement) return;

        const icon = form.querySelector(this.config.iconSelector);
        const currentCount = parseInt(countElement.innerHTML);

        if (this.config.toggleClass) {
            countElement.innerHTML = icon.classList.contains(this.config.toggleClass) ? currentCount + this.config.countChangeAmount : currentCount - this.config.countChangeAmount;
        }

        if (this.config.beforeClickIcon && this.config.afterClickIcon) {
            if (icon.classList.contains(this.config.beforeClickIcon)) {
                countElement.innerHTML = currentCount - this.config.countChangeAmount;
            }
            if (icon.classList.contains(this.config.afterClickIcon)) {
                countElement.innerHTML = currentCount + this.config.countChangeAmount;
            }
        }
    }

    async updateData(dataId, form) {
        const formData = new FormData(form);

        try {
            const response = await HttpRequest.post(`${this.config.endpoint}/${dataId}`, formData);
            if (this.config.onSuccess) {
                this.config.onSuccess(response, form, dataId);
            }
        } catch (error) {
            console.error("Error in updateData:", error);
            if (this.config.onError) {
                this.config.onError(error, form, dataId);
            }
        }
    }

    toggleIcon(form) {
        const icon = form.querySelector(this.config.iconSelector);
        if (icon) {
            if (this.config.toggleClass) {
                icon.classList.toggle(this.config.toggleClass);
            }

            if (this.config.beforeClickIcon && this.config.afterClickIcon) {
                icon.classList.toggle(this.config.beforeClickIcon);
                icon.classList.toggle(this.config.afterClickIcon);
            }
        }
    }
}

/**
 * DatatableController is a class that handles the initialization of the DataTable library.
 *
 * @param {string} tableId - The ID of the table to be handled
 * @param {Object} [options] - The options for the DataTable
 * @param {Object} [options.customFunctions] - Custom functions to be added to the DataTable
 * @param {Object} [options.eventListeners] - Event listeners to be added to the DataTable
 * @param {Object} [options.ajax] - Ajax options for the DataTable
 * @param {Object} [options.select] - Select options for the DataTable
 * @param {Object} [options.lengthMenu] - Length menu options for the DataTable
 * @param {Object} [options.order] - Order options for the DataTable
 * @param {Object} [options.searchSelector] - Search selector for the DataTable
 * @param {Object} [options.filterSelector] - Filter selector for the DataTable
 * @param {Object} [options.stateSave] - State save options for the DataTable
 * @param {Object} [options.onDraw] - Function to be called when the DataTable is drawn
 *
 * @example
 * const usersDataTable = new $DatatableController('kt_datatable_example_1', {
 *
 *  lengthMenu: [[5, 10, 20, 50, -1], [5, 10, 20, 50, "All"]],
 *  toggleToolbar: true,
 *  initColumnVisibility: true,
 *
 *  selectedAction: (selectedIds) => {
 *
 *      console.log('Performing action on ids:', selectedIds);
 *
 *  },
 *
 *   ajax: {
 *       url: `${__API_CFG__.BASE_URL}/dashboard/users/data`,
 *       data: (d) => ({
 *           ...d,
 *           name_with_4_letter: document.querySelector('input[name="name_with_4_letter"]').checked,
 *           name_with_5_letter: document.querySelector('input[name="name_with_5_letter"]').checked
 *       })
 *   },
 *
 *    columns: [
 *        { data: 'id' },
 *        { data: 'name' },
 *        { data: 'email' },
 *        { data: 'created_at' },
 *       { data: 'status' },
 *       { data: null },
 *    ],
 *
 *    columnDefs: $DatatableController.generateColumnDefs([
 *        { targets: [0], htmlType: 'selectCheckbox' },
 *        { targets: [1], htmlType: 'badge', badgeClass: 'badge-light-danger' },
 *        {
 *            targets: [4], htmlType: 'toggle',
 *            checkWhen: (data, type, row) => {
 *                return data === 'in';
 *           },
 *            uncheckWhen: (data, type, row) => {
 *                return data === 'pending';
 *            }
 *        },
 *        { targets: [-1], htmlType: 'actions', className: 'text-center', actionButtons: { edit: true, delete: true, view: true } },
 *    ]),
 *
 *    // Custom functions
 *    customFunctions: {
 *
 *        delete: async function (endpoint, onSuccess, onError) {
 *            try {
 *                const result = await SweetAlert.deleteAction();
 *                if (result) {
 *                    const response = await HttpRequest.del(endpoint);
 *                    onSuccess(response);
 *                }
 *            } catch (error) {
 *                onError(error);
 *            }
 *        },
 *
 *        show: async function (id, endpoint, onSuccess, onError) {
 *            console.log("Show user", id);
 *        },
 *
 *        edit: async function (id, endpoint, onSuccess, onError) {
 *            console.log("Edit user", id);
 *        },
 *
 *        updateStatus: async function (id, newStatus, onSuccess, onError) {
 *            try {
 *               const response = await HttpRequest.put(`${__API_CFG__.BASE_URL}/dashboard/users/update-status/${id}`, { status: newStatus });
 *                onSuccess(response);
 *            } catch (error) {
 *                onError(error);
 *            }
 *        },
 *    },
 *
 *    eventListeners: [
 *        {
 *            event: 'click',
 *            selector: '.delete-btn',
 *            handler: function (id, event) {
 *                this.callCustomFunction(
 *                    'delete',
 *                    `${__API_CFG__.BASE_URL}/dashboard/users/delete/${id}`,
 *                    (res) => {
 *                        if (res.risk) {
 *                            SweetAlert.error();
 *                        } else {
 *                            SweetAlert.deleteSuccess();
 *                            this.reload();
 *                        }
 *                    },
 *                    (err) => { console.error('Error deleting user', err); }
 *                );
 *            }
 *        },
 *        {
 *            event: 'click',
 *            selector: '.status-toggle',
 *            handler: function (id, event) {
 *                const toggle = event.target;
 *                const newStatus = toggle.checked ? 'in' : 'pending';
 *                this.callCustomFunction('updateStatus', id, newStatus,
 *                    (res) => {
 *                        Toast.showSuccessToast('', res.message);
 *                        toggle.dataset.currentStatus = newStatus;
 *                    },
 *                    (err) => {
 *                        console.error('Error updating status', err);
 *                        SweetAlert.error('Failed to update status');
 *                        toggle.checked = !toggle.checked;
 *                    }
 *                );
 *            }
 *        },
 *        {
 *            event: 'click',
 *           selector: '.btn-show',
 *           handler: function (id, event) {
 *               this.callCustomFunction('show', id);
 *            }
 *        },
 *        {
 *            event: 'click',
 *            selector: '.btn-edit',
 *            handler: function (id, event) {
 *               this.callCustomFunction('edit', id);
 *            }
 *        }
 *    ],
 * });
 *
 *
 * function addUser() {
 *    FunctionUtility.closeModalWithButton('kt_modal_stacked_2', '.close-modal', () => {
 *        FunctionUtility.clearForm('#add-user-form');
 *    });
 *
 *    const addUserConfig = {
 *        formSelector: '#add-user-form',
 *        externalButtonSelector: '#add-user-button',
 *        endpoint: `${__API_CFG__.BASE_URL}/dashboard/users/create`,
 *        feedback: true,
 *        onSuccess: (res) => {
 *            Toast.showNotificationToast('', res.message)
 *            FunctionUtility.closeModal('kt_modal_stacked_2', () => {
 *                FunctionUtility.clearForm('#add-user-form');
 *            });
 *            usersDataTable.reload();
 *        },
 *        onError: (err) => { console.error('Error adding user', err); },
 *    };
 *
 * const form = new $SingleFormPostController(addUserConfig);
 * form.init();
 *
 * addUser();
 *
 */
export class $DatatableController {
    constructor(tableId, options = {}) {
        this.tableId = tableId;
        this.options = this.mergeOptions(options);
        this.dt = null;
        this.customFunctions = new Map();
        this.eventListeners = new Map();
        this.init();
    }

    mergeOptions(options) {
        const defaultOptions = {
            searchDelay: __DATA_TABLE_CFG__.SEARCH_DELAY,
            processing: __DATA_TABLE_CFG__.PROCESSING,
            serverSide: __DATA_TABLE_CFG__.SERVER_SIDE,
            order: [[3, 'desc']],
            lengthMenu: [[__DATA_TABLE_CFG__.LENGTH_MENU], [__DATA_TABLE_CFG__.LENGTH_MENU_TEXT]],
            stateSave: __DATA_TABLE_CFG__.STATE_SAVE,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                error: (xhr) => console.error('AJAX Error:', xhr)
            },

            // search cfg
            search: __DATA_TABLE_CFG__.ENABLE_SEARCH,
            searchSelector: '[data-table-filter="search"]',

            // filter cfg
            filter: __DATA_TABLE_CFG__.ENABLE_FILTER,
            filterBoxSelector: '.filter-toolbar',
            filterMenuSelector: '#filter-menu',
            filterSelector: '[data-table-filter="filter"]',
            resetFilterSelector: '[data-table-reset="filter"]',
            resetFilter: __DATA_TABLE_CFG__.ENABLE_RESET_FILTER,

            // column cfg
            columnVisibility: __DATA_TABLE_CFG__.ENABLE_COLUMN_VISIBILITY,
            columnVisibilitySelector: '.column-visibility-container',

            // create cfg
            createButtonSelector: '.create',

            //
            toggleToolbar: __DATA_TABLE_CFG__.ENABLE_TOGGLE_TOOLBAR,
            selectedCountSelector: '[data-table-toggle-select-count="selected_count"]',
            selectedActionSelector: '[data-table-toggle-action-btn="selected_action"]',
            toolbarBaseSelector: '[data-table-toggle-base="base"]',
            toolbarSelectedSelector: '[data-table-toggle-selected="selected"]',

            // Custom action
            selectedAction: null,
        };
        return { ...defaultOptions, ...options };
    }

    init() {
        this.initDatatable();
        this.setupCustomFunctions();
        this.setupEventListeners();
        this.attachDefaultListeners();
        this.setupSelectAllCheckbox();
        this.attachResetListener();
    }

    initDatatable() {
        this.dt = $(`#${this.tableId}`).DataTable(this.options);
        this.dt.on('draw', () => this.options.onDraw?.call(this));
    }

    resetCheckboxes() {
        let filterMenu = document.querySelector(this.options.filterBoxSelector);
        const inputs = filterMenu.querySelectorAll('input');
        inputs.forEach(input => {
            input.value = '';
            if (input.type === 'checkbox') {
                input.checked = false;
            }
        });
    }

    attachResetListener() {
        if (!this.options.resetFilter) return;

        const resetButton = document.querySelector(this.options.resetFilterSelector);
        if (resetButton) {
            resetButton.addEventListener('click', () => {
                this.resetCheckboxes();
                this.reload();
            });
        }
    }

    initToggleToolbar() {
        if (!this.options.toggleToolbar) return;

        const container = document.querySelector(`#${this.tableId}`);
        const actionButton = document.querySelector(this.options.selectedActionSelector);

        container.addEventListener('change', (e) => {
            if (e.target.type === 'checkbox' && e.target.classList.contains('row-select-checkbox')) {
                setTimeout(() => this.toggleToolbars(), 50);
            }
        });

        if (actionButton && this.options.selectedAction) {
            actionButton.addEventListener('click', () => {
                const selectedIds = this.getSelectedIds();
                this.options.selectedAction(selectedIds, () => this.reload());
            });
        }
    }

    getSelectedIds() {
        const selectedCheckboxes = document.querySelectorAll(`#${this.tableId} tbody input.row-select-checkbox:checked`);
        return Array.from(selectedCheckboxes).map(checkbox => checkbox.value);
    }

    toggleToolbars() {
        if (!this.options.toggleToolbar) return;

        const container = document.querySelector(`#${this.tableId}`);
        const toolbarBase = document.querySelector(this.options.toolbarBaseSelector);
        const toolbarSelected = document.querySelector(this.options.toolbarSelectedSelector);
        const selectedCount = document.querySelector(this.options.selectedCountSelector);
        const allCheckboxes = container.querySelectorAll('tbody .row-select-checkbox');
        const filterToolbar = document.querySelector(this.options.filterBoxSelector);
        const createButton = document.querySelector(this.options.createButtonSelector);

        let checkedState = false;
        let count = 0;

        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        if (toolbarSelected && toolbarBase && selectedCount) {
            if (checkedState) {
                selectedCount.innerHTML = `${count}`;
                toolbarBase.classList.add('d-none');
                toolbarSelected.classList.remove('d-none');
                createButton.classList.add('d-none');
                filterToolbar.classList.add('d-none');
            } else {
                toolbarBase.classList.remove('d-none');
                toolbarSelected.classList.add('d-none');
                createButton.classList.remove('d-none');
                filterToolbar.classList.remove('d-none');
            }
        } else {
            console.error('One or more toolbar elements not found');
        }
    }

    initColumnVisibility() {
        if (!this.options.columnVisibility) return;

        const container = document.querySelector(`#${this.tableId}_wrapper`);
        if (!container) return;

        const menuBody = document.getElementById('column-toggles');
        if (!menuBody) return;

        menuBody.innerHTML = '';

        this.dt.columns().every(function (index) {
            const column = this;
            const title = column.header().textContent.trim();

            const toggleContainer = document.createElement('div');
            toggleContainer.className = 'form-check form-switch form-check-custom form-check-solid mb-3';

            const checkbox = document.createElement('input');
            checkbox.className = 'form-check-input';
            checkbox.type = 'checkbox';
            checkbox.checked = column.visible();
            checkbox.id = `column_toggle_${index}`;

            const label = document.createElement('label');
            label.className = 'form-check-label';
            label.htmlFor = `column_toggle_${index}`;
            label.textContent = title;

            checkbox.addEventListener('change', function () {
                column.visible(this.checked);
            });

            toggleContainer.appendChild(checkbox);
            toggleContainer.appendChild(label);
            menuBody.appendChild(toggleContainer);
        });

        // Add the button container to the DataTable wrapper if it's not already added
        const buttonContainer = document.querySelector('.column-visibility-container');
        const tableControlsContainer = container.querySelector('.dataTables_wrapper .row:first-child .col-sm-6:last-child');
        if (tableControlsContainer && !tableControlsContainer.contains(buttonContainer)) {
            tableControlsContainer.appendChild(buttonContainer);
        }
        KTMenu.createInstances();
    }

    attachDefaultListeners() {
        if (this.options.search) this.attachSearchListener();
        if (this.options.filter) this.attachFilterListener();
        if (this.options.toggleToolbar) this.initToggleToolbar();
        if (this.options.resetFilter) this.attachResetListener();
        if (this.options.columnVisibility) this.initColumnVisibility();
    }

    attachFilterListener() {
        const filterElement = document.querySelector(this.options.filterSelector);
        if (filterElement) {
            filterElement.addEventListener('click', () => this.reload());
        }
    }

    attachSearchListener() {
        const searchElement = document.querySelector(this.options.searchSelector);
        if (searchElement) {
            searchElement.addEventListener('keyup', (e) => {
                this.dt.search(e.target.value).draw();
            });
        }
    }

    setupCustomFunctions() {
        if (this.options.customFunctions) {
            for (const [name, func] of Object.entries(this.options.customFunctions)) {
                this.addCustomFunction(name, func);
            }
        }
    }

    addCustomFunction(name, func) {
        this.customFunctions.set(name, func.bind(this));
    }

    setupEventListeners() {
        if (this.options.eventListeners) {
            for (const listener of this.options.eventListeners) {
                this.addEventListener(listener.event, listener.selector, listener.handler);
            }
        }
    }

    addEventListener(event, selector, handler) {
        const wrappedHandler = (e) => {
            const id = e.currentTarget.getAttribute('data-id');
            handler.call(this, id, e);
        };
        $(`#${this.tableId}`).on(event, selector, wrappedHandler);

        if (!this.eventListeners.has(event)) {
            this.eventListeners.set(event, new Map());
        }
        this.eventListeners.get(event).set(selector, wrappedHandler);
    }

    removeEventListener(event, selector) {
        if (this.eventListeners.has(event) && this.eventListeners.get(event).has(selector)) {
            $(`#${this.tableId}`).off(event, selector, this.eventListeners.get(event).get(selector));
            this.eventListeners.get(event).delete(selector);
        }
    }

    setupSelectAllCheckbox() {
        const tableId = this.tableId;
        const selectAllCheckbox = document.querySelector(`#${tableId} .select-all-checkbox`);

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('click', (e) => {
                const isChecked = e.target.checked;
                const rowCheckboxes = document.querySelectorAll(`#${tableId} .row-select-checkbox`);

                rowCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });

                this.toggleToolbars();
            });

            // Update "select all" checkbox state when individual checkboxes change
            document.querySelector(`#${tableId} tbody`).addEventListener('change', (e) => {
                if (e.target.classList.contains('row-select-checkbox')) {
                    const allCheckboxes = document.querySelectorAll(`#${tableId} .row-select-checkbox`);
                    const checkedCheckboxes = document.querySelectorAll(`#${tableId} .row-select-checkbox:checked`);
                    selectAllCheckbox.checked = allCheckboxes.length === checkedCheckboxes.length;

                    this.toggleToolbars();
                }
            });
        }
    }

    reload() {
        this.dt.ajax.reload(null, false);
    }

    callCustomFunction(functionName, ...args) {
        if (this.customFunctions.has(functionName)) {
            return this.customFunctions.get(functionName)(...args);
        } else {
            console.error(`Custom function ${functionName} not found`);
        }
    }

    destroy() {
        this.dt.destroy();
        this.eventListeners.forEach((listeners, event) => {
            listeners.forEach((_, selector) => {
                this.removeEventListener(event, selector);
            });
        });
        this.customFunctions.clear();
        this.eventListeners.clear();
    }

    getDataTable() {
        return this.dt;
    }

    static generateColumnDefs(columnConfigs) {
        return columnConfigs.map(config => {
            const {
                htmlType, targets, orderable = __DATA_TABLE_CFG__.ORDERABLE,
                className = '', customRender, checkWhen,
                uncheckWhen, hrefFunction, dataClassName = '',
                actionButtons = __DATA_TABLE_CFG__.ACTION_BUTTONS,
                badgeClass = ''
            } = config;

            let renderFunction;

            switch (htmlType) {

                case 'link':
                    renderFunction = function (data, type, row) {
                        const href = typeof hrefFunction === 'function' ? hrefFunction(data, type, row) : data;
                        return `<a href="${href}" target="_blank" class="${dataClassName}">${data}</a>`;
                    };
                    break;

                case 'number':
                    renderFunction = function (data) {
                        return `<span class="${dataClassName}">${Number(data).toLocaleString()}</span>`;
                    };
                    break;

                case 'badge':
                    renderFunction = function (data) {
                        return `<span class="badge ${badgeClass} ${dataClassName}">${data}</span>`;
                    };
                    break;

                case 'icon':
                    renderFunction = function (data) {
                        return `<i class="${data} ${dataClassName}"></i>`;
                    };
                    break;

                case 'toggle':
                    renderFunction = (data, type, row) => {
                        const isChecked = typeof checkWhen === 'function' ? checkWhen(data, type, row) : checkWhen;
                        const isUnchecked = typeof uncheckWhen === 'function' ? uncheckWhen(data, type, row) : uncheckWhen;

                        if (isChecked && isUnchecked) {
                            console.warn("Both checkWhen and uncheckWhen are defined. Only checkWhen will be considered.");
                        }

                        return `
            <div class="form-check form-switch">
                <input class="form-check-input ${dataClassName}" type="checkbox"
                    id="statusToggle_${row.id}"
                    ${isChecked || (data === 'active' && !isUnchecked) ? 'checked' : ''}
                    data-id="${row.id}">
            </div>
        `;
                    };
                    break;

                case 'selectCheckbox':
                    renderFunction = function (data, type, row) {
                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input row-select-checkbox" type="checkbox" value="${row.id}" />
                            </div>
                        `;
                    };
                    break;

                case 'actions':
                    renderFunction = function (data) {
                        return `
                                <div class="btn-group" role="group">
                                    ${actionButtons.edit ? `
                                        <button data-id="${data.id}" type="button" class="btn datatable-btn btn-edit data-table-action-edit btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                            <i class="bi bi-pencil fs-5" style="color: #007bff;"></i>
                                        </button>` : ''}
                                    ${actionButtons.view ? `
                                        <button data-id="${data.id}" type="button" class="btn mx-1 datatable-btn btn-show data-table-action-show btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                            <i class="bi bi-eye fs-5" style="color: #28a745;"></i>
                                        </button>` : ''}
                                    ${actionButtons.delete ? `
                                        <button data-id="${data.id}" type="button" class="btn datatable-btn mx-1 delete-btn data-table-action-delete btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                            <i class="bi bi-trash3-fill fs-5" style="color: #dc3545;"></i>
                                        </button>` : ''}
                                </div>`;
                    };
                    break;

                default:
                    renderFunction = customRender || function (data) {
                        return `<span class="${dataClassName}">${data}</span>`;
                    };
                    break;
            }

            return {
                targets: targets,
                orderable: orderable,
                className: className,
                render: renderFunction
            };
        });
    }
}

/**
 * Controller for handling modal forms with data fetching functionality.
 * @class
 * Creates an instance of $ModalFormFetchController.
 * @param {Object} config - Configuration object for the controller.
 * @param {string} config.modalId - ID of the modal element.
 * @param {string} config.endpoint - API endpoint for fetching data.
 * @param {string} config.formId - ID of the form element.
 * @param {string} [config.submitBtnId] - ID of the submit button (optional).
 * @param {string} [config.closeBtnClass='close-edit-modal'] - Class of the close button.
 * @param {Function} [config.onSuccess] - Callback function on successful data fetch.
 * @param {Function} [config.onError] - Callback function on error.
 * @param {Function} [config.onSubmit] - Callback function on form submission.
 *
 * @example
 * new $ModalFormFetchController({
 *     modalId: 'edit-modal',
 *     endpoint: `${endpoint}`,
 *     formId: '#edit-navbar-form',
 *     onSuccess: (data) => {
 *         onSuccess(data);
 *     },
 *     onError: (error) => {
 *         onError(error);
 *     },
 * });
 */
export class $ModalFormFetchController {
    /**
     * Creates an instance of $ModalFormFetchController.
     * @param {Object} config - Configuration object for the controller.
     */
    constructor(config) {
        this.config = {
            modalId: '',
            endpoint: '',
            formId: '',
            submitBtnId: '',
            closeBtnClass: 'close-edit-modal',
            onSuccess: () => { },
            onError: () => { },
            onSubmit: () => { },
            ...config
        };

        this.modal = null;
        this.form = null;
        this.setupEventListeners();
    }

    /**
     * Sets up event listeners for the modal.
     * @private
     */
    setupEventListeners() {
        // Close modal buttons
        document.querySelectorAll(`.${this.config.closeBtnClass}`).forEach(btn => {
            btn.addEventListener('click', () => {
                this.closeModal();
                FunctionUtility.clearForm(`${this.config.formId}`)
            });
        });
    }

    /**
     * Shows a skeleton loader in the modal body.
     * @private
     */
    showSkeleton() {
        const modalBody = document.querySelector(`#${this.config.modalId} .modal-body`);
        const form = document.querySelector(this.config.formId);
        form.style.display = 'none';
        if (modalBody && form) {
            modalBody.insertAdjacentHTML('afterbegin', `
                <div class="skeleton-overlay">
                    <div class="skeleton-wrapper">
                        <div class="skeleton-header"></div>
                        <div class="skeleton-text"></div>
                        <div class="skeleton-text"></div>
                        <div class="skeleton-text"></div>
                        <div class="skeleton-button"></div>
                    </div>
                </div>
            `);
        }
    }

    /**
     * Hides the skeleton loader and shows the form.
     * @private
     */
    hideSkeleton() {
        const skeletonOverlay = document.querySelector(`#${this.config.modalId} .skeleton-overlay`);
        if (skeletonOverlay) {
            skeletonOverlay.remove();
            const form = document.querySelector(this.config.formId);
            form.style.display = 'block';
        }
    }

    /**
     * Shows the modal and fetches data for the given ID.
     * @param {string|number} id - The ID of the item to fetch.
     * @returns {Promise<void>}
     */
    async show(id) {
        try {
            this.showModal();
            this.showSkeleton();
            const response = await HttpRequest.get(`${this.config.endpoint}/${id}`);
            this.hideSkeleton();
            this.populateForm(response);
            this.config.onSuccess(response);
        } catch (error) {
            this.hideSkeleton();
            console.error('Error fetching data:', error);
            this.config.onError(error);
        }
    }

    /**
     * Shows the modal.
     * @private
     */
    showModal() {
        this.modal = new bootstrap.Modal(document.getElementById(this.config.modalId));
        this.modal.show();
    }

    /**
     * Closes the modal.
     */
    closeModal() {
        if (this.modal) {
            this.modal.hide();
        }
    }

    /**
     * Populates the form with the fetched data.
     * @param {Object} data - The data to populate the form with.
     * @private
     */
    populateForm(data) {
        this.form = document.querySelector(this.config.formId);
        if (!this.form) {
            console.error(`Form with id "${this.config.formId}" not found`);
            return;
        }

        for (const [key, value] of Object.entries(data)) {
            const input = this.form.elements[key];
            if (input) {
                if (input.type == 'checkbox') {
                    input.checked = value == 1 ||
                        value == true ||
                        value == 'active' ||
                        value == '1' ||
                        value == 'true' ||
                        value == 'public' ||
                        value == 'available';
                }
                else if (input.tagName.toLowerCase() === 'textarea') {
                    input.value = value;
                }
                else if (this.config.quillSelector && document.querySelector(this.config.quillSelector)) {
                    const quillEditor = Quill.find(document.querySelector(this.config.quillSelector));
                    if (quillEditor) {
                        quillEditor.root.innerHTML = value;
                    }
                    const hiddenInput = this.form.querySelector(`input[name="${key}"]`);
                    if (hiddenInput) {
                        hiddenInput.value = value;
                    }
                }
                else if (input.tagName.toLowerCase() === 'textarea') {
                    input.value = value;
                }
                else {
                    input.value = value;
                }
            } else {
                // Handle hidden inputs that might not be picked up by this.form.elements
                const hiddenInput = this.form.querySelector(`input[name="${key}"]`);
                if (hiddenInput) {
                    hiddenInput.value = value;
                } else {
                    // Check for textarea if input is not found
                    const textarea = this.form.querySelector(`textarea[name="${key}"]`);
                    if (textarea) {
                        textarea.value = value;
                    }
                }
            }
        }
    }

    /**
     * Handles form submission.
     * @param {Event} e - The submit event.
     * @returns {Promise<void>}
     */
    async handleSubmit(e) {
        if (!this.form) {
            console.error('Form not initialized');
            return;
        }

        const formData = new FormData(this.form);
        const id = formData.get('id');

        try {
            if (typeof this.config.onSubmit === 'function') {
                await this.config.onSubmit(id, formData, this);
            } else {
                console.error('onSubmit is not a function');
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            this.config.onError(error);
        }
    }

    /**
     * Gets the form data.
     * @returns {FormData|null} The form data or null if the form is not initialized.
     */
    getFormData() {
        if (!this.form) {
            console.error('Form not initialized');
            return null;
        }
        return new FormData(this.form);
    }
}
JS;

        $this->addCodeToFile($authPath, $code);
        $this->info('The controllers.js file has been updated successfully.');
    }
}
