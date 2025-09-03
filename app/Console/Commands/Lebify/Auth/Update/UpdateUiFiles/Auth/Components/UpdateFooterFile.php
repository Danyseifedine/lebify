<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateUiFiles\Auth\Components;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateFooterFile extends Command
{

    use CodeManipulationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:auth-footer';
    protected $description = 'Update the auth footer file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $footerViewPath = resource_path('views/auth/components/footer.blade.php');

        if (!File::exists($footerViewPath)) {
            $this->error('The footer.blade.php file does not exist in the views/auth directory.');
            return;
        }

        $content = <<<'HTML'
<div class="d-flex align-items-center justify-content-around gap-20">
    <div class="m-0 mt-5 px-5">
        <!--begin::Toggle-->
        @switch(App::getLocale())
            @case('en')
                <button class="btn btn-flex btn-link rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                    data-kt-menu-offset="0px, 0px">
                    <img data-kt-element="current-lang-flag" class="w-25px h-25px rounded-circle me-3"
                        src="{{ asset('vendor/img/flags/united-states.svg') }}" alt="" />
                    <span data-kt-element="current-lang-name" class="me-2">{{ __('common.english') }}</span>
                    <i class="ki-duotone ki-down fs-2 text-muted rotate-180 m-0"></i>
                </button>
            @break

            @case('ar')
                <button class="btn btn-flex btn-link rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                    data-kt-menu-offset="0px, 0px">
                    <img data-kt-element="current-lang-flag" class="w-25px h-25px rounded-circle me-3"
                        src="{{ asset('vendor/img/flags/saudi-arabia.svg') }}" alt="" />
                    <span data-kt-element="current-lang-name" class="me-2">{{ __('common.arabic') }}</span>
                    <i class="ki-duotone ki-down fs-2 text-muted rotate-180 m-0"></i>
                </button>
            @break

            @case('fr')
                <button class="btn btn-flex btn-link rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                    data-kt-menu-offset="0px, 0px">
                    <img data-kt-element="current-lang-flag" class="w-25px h-25px rounded-circle me-3"
                        src="{{ asset('vendor/img/flags/france.svg') }}" alt="" />
                    <span data-kt-element="current-lang-name" class="me-2">{{ __('common.french') }}</span>
                    <i class="ki-duotone ki-down fs-2 text-muted rotate-180 m-0"></i>
                </button>
            @break

            @default
        @endswitch
        <!--end::Toggle-->
        <!--begin::Menu-->
        <div class="languageBox menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4"
            data-kt-menu="true" id="kt_auth_lang_menu">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="menu-link d-flex px-5"
                    data-kt-lang="English">
                    <span class="symbol symbol-20px me-4">
                        <img data-kt-element="lang-flag" class="rounded-1"
                            src="{{ asset('vendor/img/flags/united-states.svg') }}" alt="" />
                    </span>
                    <span data-kt-element="lang-name">{{ __('common.english') }}</span>
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="menu-link d-flex px-5"
                    data-kt-lang="Saudi-arabia">
                    <span class="symbol symbol-20px me-4">
                        <img data-kt-element="lang-flag" class="rounded-1"
                            src="{{ asset('vendor/img/flags/saudi-arabia.svg') }}" alt="" />
                    </span>
                    <span data-kt-element="lang-name">{{ __('common.arabic') }}</span>
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ LaravelLocalization::getLocalizedURL('fr') }}" class="menu-link d-flex px-5"
                    data-kt-lang="French">
                    <span class="symbol symbol-20px me-4">
                        <img data-kt-element="lang-flag" class="rounded-1"
                            src="{{ asset('vendor/img/flags/france.svg') }}" alt="" />
                    </span>
                    <span data-kt-element="lang-name">{{ __('common.french') }}</span>
                </a>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu-->
    </div>

    {{-- <div class="app-navbar-item ms-1 ms-md-4 mt-5">
        <!--begin::Menu toggle-->
        <a href="#"
            class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px show menu-dropdown"
            data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <i class="bi bi-brightness-high theme-light-show fs-1"></i>
            <i class="bi bi-moon theme-dark-show fs-1"></i>
        </a>
        <!--begin::Menu toggle-->
        <!--begin::Menu-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-60px show"
            data-kt-menu="true" data-kt-element="theme-mode-menu"
            style="z-index: 107; position: fixed; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-78px, 74px, 0px);"
            data-popper-placement="bottom-end">
            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2 active" data-kt-element="mode" data-kt-value="light">
                    <i class="bi bi-brightness-high fs-2"></i>
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                    <i class="bi bi-moon fs-2"></i>
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                    <i class="bi bi-display fs-2"></i>
                </a>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu-->
    </div> --}}
</div>

HTML;

        $this->addCodeToFile($footerViewPath, $content);
        $this->info('The footer.blade.php file has been updated successfully.');
    }
}
