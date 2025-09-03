<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateUiFiles\Auth;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateRegisterViewFile extends Command
{
    use CodeManipulationTrait;

    protected $signature = 'update:register-view';
    protected $description = 'Update the register view file';

    public function handle()
    {
        $registerViewPath = resource_path('views/auth/register.blade.php');

        if (!File::exists($registerViewPath)) {
            $this->error('The register.blade.php file does not exist in the views/auth directory.');
            return;
        }

        $content = <<<'HTML'
@extends('layouts.auth')

@section('title', 'Register')


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
                                <span class="text-gray-500 fw-bold fs-5 me-2">{{ __('auth.already_have_account') }}</span>
                                <a href="{{ route('login') }}"
                                    class="text-logo fw-bold fs-5">{{ __('actions.sign_in') }}</a>
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
                        <form method="POST" id="register-form" action="{{ route('register') }}">
                            @csrf

                            <!--begin::Heading-->
                            <div class="text-start mb-10">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 mb-3 fs-3x">{{ __('auth.join_now') }}
                                </h1>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="text-gray-500 fw-semibold fs-6">{{ __('auth.dive_into_our_community') }}.</div>
                                <!--end::Link-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <!--begin::Col-->
                                <div class="col-xl-12">
                                    <input class="form-control form-control-lg form-control-solid" type="text"
                                        placeholder="{{ __('common.full_name') }}" name="name" id="name"
                                        autocomplete="off" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <input class="form-control form-control-lg form-control-solid" type="text"
                                    placeholder="{{ __('common.email') }}" name="email" id="email"
                                    autocomplete="off" />
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control form-control-lg form-control-solid" type="password"
                                            placeholder="{{ __('common.password') }}" name="password" autocomplete="off"
                                            id="password" />
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
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Hint-->
                                <div class="text-muted" data-kt-translate="sign-up-hint">{{ __('auth.use_8_character') }}
                                </div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    placeholder="{{ __('common.confirm_password') }}" id="password_confirmation"
                                    name="password_confirmation" autocomplete="off" />
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex flex-stack">
                                <!--begin::Submit-->
                                <button class="btn bg-logo d-flex align-items-center justify-content-center gap-2"
                                    loading="{{ __('common.registering') }}" with-spinner="true" type="submit">
                                    <span class="ld-span">{{ __('auth.register') }}</span>
                                </button>
                                <!--end::Submit-->
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
        <script src="{{ asset('js/auth/register.js') }}" type="module"></script>
    @endpush
@endsection

HTML;

        $this->addCodeToFile($registerViewPath, $content);

        $this->info('The register.blade.php file has been updated successfully.');
    }
}
