<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateUiFiles\Auth;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdatePasswordResetFile extends Command
{
    use CodeManipulationTrait;

    protected $signature = 'update:reset-view';
    protected $description = 'Update the reset view file';

    public function handle()
    {
        $resetPasswordViewPath = resource_path('views/auth/passwords/reset.blade.php');

        if (!File::exists($resetPasswordViewPath)) {
            $this->error('The reset.blade.php file does not exist in the views/auth directory.');
            return;
        }

        $content = <<<'HTML'
        @extends('layouts.auth')

@section('title', 'Reset')


@section('content')
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="auth d-flex flex-column flex-center flex-column-fluid p-10">
            <!--begin::Authentication - Sign-in -->
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <!--begin::Aside-->
                <div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-10">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column-fluid flex-column w-100 mw-450px">
                        <!--begin::Header-->
                        <div class="d-flex flex-stack py-2">
                            <!--begin::Back link-->
                            <div class="me-2">
                                <a href="{{ route('register') }}" class="btn btn-icon bg-light rounded-circle">
                                    <i class="ki-duotone ki-black-left fs-2 text-gray-800"></i>
                                </a>
                            </div>
                            <!--end::Back link-->
                            <!--begin::Sign Up link-->
                            <div class="m-0">
                                <span class="text-gray-500 fw-bold fs-5 me-2"
                                    data-kt-translate="new-password-head-desc">{{ __('auth.already_have_account') }}</span>
                                <a href="" class="text-logo fw-bold fs-5"
                                    data-kt-translate="new-password-head-link">{{ __('actions.sign_in') }}</a>
                            </div>
                            <!--end::Sign Up link=-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="text-center fs-2 fw-bold py-20">
                            <img src="{{ asset('vendor/img/logo/logo-icon.png') }}" width="70" alt=""
                                style="animation: spin 2s linear infinite;">
                        </div>
                        <!--begin::Form-->
                        <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                            id="reset-form" method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            <!--begin::Heading-->
                            <div class="text-start mb-10">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 mb-3 fs-3x" data-kt-translate="new-password-title">
                                    {{ __('auth.setup_new_password') }}</h1>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="text-gray-500 fw-semibold fs-6" data-kt-translate="new-password-desc">
                                    {{ __('auth.Has_reset_password') }}</div>
                                <!--end::Link-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" placeholder="{{ __('common.email') }}" id="email" name="email"
                                    autocomplete="off"
                                    class="form-control form-control-solid"value="{{ $email ?? old('email') }}" />
                                <!--end::Email-->
                            </div>
                            <div class="mb-10 fv-row fv-plugins-icon-container" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control form-control-lg form-control-solid" type="password"
                                            placeholder="{{ __('common.password') }}" name="password" autocomplete="off"
                                            id="password">
                                        <span
                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                            <i class="ki-duotone ki-eye-slash fs-2"></i>
                                            <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                    <!--end::Input wrapper-->
                                    <!--begin::Meter-->
                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Hint-->
                                <div class="text-muted" data-kt-translate="new-password-hint">
                                    {{ __('auth.use_8_character') }}</div>
                                <!--end::Hint-->
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-10 fv-plugins-icon-container">
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    placeholder="{{ __('common.confirm_password') }}" name="password_confirmation"
                                    autocomplete="off" id="password_confirmation">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Actions-->
                            <div class="d-flex flex-stack">
                                <!--begin::Link-->
                                <button class="btn bg-logo d-flex align-items-center justify-content-center gap-2"
                                    loading="{{ __('common.reseting') }}" with-spinner="true" type="submit">
                                    <span class="ld-span">{{ __('auth.reset_password') }}</span>
                                </button>
                                <!--end::Link-->
                                <!--begin::Social-->
                                <div class="d-flex align-items-center">
                                    <div class="text-gray-500 fw-semibold fs-6 me-3 me-md-6">{{ __('auth.or') }}</div>
                                    <!--begin::Symbol-->
                                    <a href="#" class="symbol symbol-circle symbol-45px w-45px bg-light me-3">
                                        <img alt="Logo" src="{{ asset('vendor/img/icon/google-icon.svg') }}"
                                            class="p-4" />
                                    </a>
                                    <!--end::Symbol-->
                                    <!--begin::Symbol-->
                                    <a href="#" class="symbol symbol-circle symbol-45px w-45px bg-light me-3">
                                        <img alt="Logo" src="{{ asset('vendor/img/icon/facebook-3.svg') }}"
                                            class="p-4" />
                                    </a>
                                    <!--end::Symbol-->
                                </div>
                                <!--end::Social-->
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="m-0 mt-5">
                        <!--begin::Toggle-->
                        @switch(App::getLocale())
                            @case('en')
                                <button class="btn btn-flex btn-link rotate" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                                    <img data-kt-element="current-lang-flag" class="w-25px h-25px rounded-circle me-3"
                                        src="{{ asset('vendor/img/flags/united-states.svg') }}" alt="" />
                                    <span data-kt-element="current-lang-name" class="me-2">{{ __('common.english') }}</span>
                                    <i class="ki-duotone ki-down fs-2 text-muted rotate-180 m-0"></i>
                                </button>
                            @break

                            @case('ar')
                                <button class="btn btn-flex btn-link rotate" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                                    <img data-kt-element="current-lang-flag" class="w-25px h-25px rounded-circle me-3"
                                        src="{{ asset('vendor/img/flags/saudi-arabia.svg') }}" alt="" />
                                    <span data-kt-element="current-lang-name" class="me-2">{{ __('common.arabic') }}</span>
                                    <i class="ki-duotone ki-down fs-2 text-muted rotate-180 m-0"></i>
                                </button>
                            @break

                            @case('fr')
                                <button class="btn btn-flex btn-link rotate" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
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
                    <!--end::Footer-->
                </div>
                <!--end::Wrapper-->
            </div>

            <!--begin::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>

    @push('scripts')
        <script src="{{ asset('js/auth/reset.js') }}" type="module"></script>
    @endpush
@endsection

HTML;
        $this->addCodeToFile($resetPasswordViewPath, $content);
        $this->info('The reset.blade.php file has been updated successfully.');
    }
}
