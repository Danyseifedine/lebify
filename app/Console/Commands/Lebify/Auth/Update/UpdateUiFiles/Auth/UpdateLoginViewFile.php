<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateUiFiles\Auth;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateLoginViewFile extends Command
{
    use CodeManipulationTrait;

    protected $signature = 'update:login-view';
    protected $description = 'Update the login view file';

    public function handle()
    {
        $loginViewPath = resource_path('views/auth/login.blade.php');

        if (!File::exists($loginViewPath)) {
            $this->error('The login.blade.php file does not exist in the views/auth directory.');
            return;
        }

        $content = <<<'HTML'
@extends('layouts.auth')

@section('title', 'Login')


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
                            <div class="me-2"></div>
                            <!--end::Back link-->
                            <!--begin::Sign Up link-->
                            <div class="m-0">
                                <span class="text-gray-500 fw-bold fs-5 me-2">{{ __('auth.not_a_member') }}</span>
                                <a href="{{ route('register') }}"
                                    class="text-logo fw-bold fs-5">{{ __('auth.sign_up') }}</a>
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
                        <form method="POST" action="{{ route('login') }}" id="login-form">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Heading-->
                                <div class="text-start mb-10">
                                    <!--begin::Title-->
                                    <h1 class="text-gray-900 mb-3 fs-3x">{{ __('auth.entrance_point') }}</h1>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <div class="text-gray-500 fw-semibold fs-6">{{ __('auth.explore_a_sanctuary') }}
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Email-->
                                    <input type="text" placeholder="{{ __('common.email') }}" id="email"
                                        name="email" autocomplete="off" class="form-control form-control-solid" />
                                    <!--end::Email-->
                                </div>
                                <!--end::Input group=-->
                                <div class="fv-row mb-7">
                                    <!--begin::Password-->
                                    <input type="password" placeholder="{{ __('common.password') }}" id="password"
                                        name="password" autocomplete="off" class="form-control form-control-solid" />
                                    <!--end::Password-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-10">
                                    <div></div>
                                    <!--begin::Link-->
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}"
                                            class="text-logo">{{ __('auth.forget_password') }}</a>
                                    @endif
                                    <!--end::Link-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Actions-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Submit-->
                                    <button class="btn bg-logo d-flex align-items-center justify-content-center gap-2"
                                        loading="{{ __('common.loggingin') }}" with-spinner="true" type="submit">
                                        <span class="ld-span">{{ __('validation.attributes.login') }}</span>
                                    </button>
                                    <!--end::Submit-->
                                    <!--begin::Social-->
                                    <div class="d-flex align-items-center">
                                        <div class="text-gray-500 fw-semibold fs-6 me-3 me-md-6">{{ __('auth.or') }}
                                        </div>
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
                            </div>
                            <!--begin::Body-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    @include('auth.components.footer')
                    <!--end::Footer-->
                </div>
                <!--end::Wrapper-->
            </div>

            <!--begin::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    @push('scripts')
        <script src="{{ asset('js/auth/login.js') }}" type="module"></script>
    @endpush
@endsection

HTML;

        $this->addCodeToFile($loginViewPath, $content);
        $this->info('The login.blade.php file has been updated successfully.');
    }
}
