<?php

namespace App\Console\Commands\Lebify\Auth\Update\UpdateUiFiles\Auth;

use App\Traits\CodeManipulationTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdatesendPasswordResetFile extends Command
{
    use CodeManipulationTrait;

    protected $signature = 'update:email-view';
    protected $description = 'Update the email view file';

    public function handle()
    {
        $emailViewPath = resource_path('views/auth/passwords/email.blade.php');

        if (!File::exists($emailViewPath)) {
            $this->error('The email.blade.php file does not exist in the views/auth directory.');
            return;
        }

        $content = <<<'HTML'
@extends('layouts.auth')

@section('title', 'email')


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
                        <form class="py-10" method="POST" action="{{ route('password.email') }}" id="send-email-form">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-start mb-10">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 mb-3 fs-3x">{{ __('auth.forget_password') }}</h1>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <div class="text-gray-500 fw-semibold fs-6">
                                    {{ __('auth.enter_reset_email') }}
                                </div>
                                <!--end::Link-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10 fv-plugins-icon-container">
                                <input type="text" placeholder="{{ __('common.email') }}" id="email" name="email"
                                    autocomplete="off" class="form-control form-control-solid" />
                            </div>

                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex flex-stack">
                                <!--begin::Link-->
                                <div class="m-0 d-flex align-items-center gap-2">
                                    <button class="btn bg-logo d-flex align-items-center justify-content-center gap-2"
                                        loading="{{ __('common.sending') }}" with-spinner="true" type="submit">
                                        <span class="ld-span">{{ __('auth.send_pass') }}</span>
                                    </button>
                                    <a href="{{ route('login') }}"
                                        class="btn text-logo fw-bold btn-hover">{{ __('common.cancel') }}</a>
                                </div>
                                <!--end::Link-->
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
        <script src="{{ asset('js/auth/email.js') }}" type="module"></script>
    @endpush
@endsection
HTML;

        $this->addCodeToFile($emailViewPath, $content);
        $this->info('The email.blade.php file has been updated successfully.');
    }
}
