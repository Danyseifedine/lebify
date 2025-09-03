<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateJsFiles\Common\Base;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;

class UpdateLoadingButtonFile extends Command
{
    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:loadingButton-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the loadingButton.js file with the provided code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $loadingButtonJsFilePath = public_path('js/common/base/loadingButton/loadingButton.js');

        $code = <<<'JS'
import { __LOADING_CFG__ } from "../config/config.js";

const loadingTemplate = {
    version_1: `<span class="sp spinner-border spinner-border-sm spinner_1" role="status" aria-hidden="true" style="display: none;"></span>`,
    version_2: `<span class="sp spinner-border spinner-border-md spinner_3" role="status" aria-hidden="true" style="display: none;"></span>`,
    version_3: `<div class="sp loading_version_3">`,
    version_4: `<div class="sp loading_version_4">`,
    version_5: `<div class="sp loading_version_5">`,
    version_6: `<div class="sp loading_version_6">`,
    version_7: `<div class="sp loading_version_7">`,
    version_8: `<div class="sp loading_version_8">`,
    version_9: `<div class="sp loading_version_9">`,
    version_10: `<div class="sp">
        <div class="spinner-box loading_full_screen_version loading_version_10">
        <div class="blue-orbit leo">
        </div>

        <div class="green-orbit leo">
        </div>

        <div class="red-orbit leo">
        </div>

        <div class="white-orbit w1 leo">
        </div>
        <div class="white-orbit w2 leo">
        </div>
        <div class="white-orbit w3 leo">
        </div>
    </div>
</div>`,
    version_11: `<div class="sp loading_full_screen_version"><div class="loading_version_11"></div></div>`
};



export class ButtonLoadingState {
    /**
     * Initializes the loading state for a button with a spinner and text.
     * @param {HTMLButtonElement} button - The button element.
     * @param {string} templateVersion - The version of the loading template to use.
     * @param {string} spinnerSize - The size of the spinner to use.
     */
    constructor(button, templateVersion = __LOADING_CFG__.DEFAULT_LOADING_VERSION) {
        this.button = button;
        this.loadingText = this.button.getAttribute(__LOADING_CFG__.DEFAULT_LOADING_ATTRIBUTE) || __LOADING_CFG__.DEFAULT_LOADING_TEXT;
        this.originalText = this.button.querySelector('.ld-span').textContent.trim();
        this.withSpinner = this.button.getAttribute(__LOADING_CFG__.DEFAULT_LOADING_SPINNER_ATTRIBUTE) === __LOADING_CFG__.SHOW_SPINNER;

        if (this.withSpinner) {
            this.spinnerTemplate = loadingTemplate[templateVersion];
            if (!this.button.querySelector('.sp')) {
                this.button.insertAdjacentHTML('afterbegin', this.spinnerTemplate);
            }
            this.spinnerElement = this.button.querySelector('.sp');
        }
    }

    /**
     * Activates the loading state for the button.
     */
    activate() {
        this.button.querySelector('.ld-span').textContent = this.loadingText;
        if (this.withSpinner) {
            this.spinnerElement.style.display = 'inline-block';
        }
        this.button.disabled = true;
    }

    /**
     * Resets the button to its original state after loading.
     */
    reset() {
        this.button.querySelector('.ld-span').textContent = this.originalText;
        if (this.withSpinner) {
            this.spinnerElement.style.display = 'none';
        }
        this.button.disabled = false;
    }
}
JS;

        $this->addCodeToFile($loadingButtonJsFilePath, $code);
        $this->info('The loadingButton.js file has been updated successfully.');
    }
}
