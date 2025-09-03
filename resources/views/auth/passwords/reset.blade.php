@extends('web.dashboard.layouts.auth')

@section('title', 'Reset Your Password')
@section('meta_description', 'Set up a new password for your Lebify account. Secure your access to our innovative tools and services for digital projects.')
@section('meta_keywords', 'password reset, new password, account security, Lebify, digital projects, innovation')

@section('og_title', 'Create a New Password for Your Lebify Account')
@section('og_description', 'Reset your Lebify account password and regain access to our cutting-edge tools for digital innovation and development.')

@section('twitter_title', 'Secure Your Lebify Account - Set New Password')
@section('twitter_description', 'Create a new password for your Lebify account. Get back to empowering your digital projects with our innovative tools and services.')


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/project/auth.css') }}">
@endpush







@section('content')
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <!--begin::Title-->
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Empowering Innovation with <span
                            class="text-logo fw-bolder lebify fs-2qx">Lebify</span></h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        Join Lebify and unlock a world of free applications, APIs, and services for your digital projects.
                        <br />Create your account to access cutting-edge tools that drive innovation and empower developers.
                        <br />Start your journey with us today and accelerate your project success!
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <!--begin::Wrapper-->
                <div class="bg-body d-flex flex-column flex-center card rounded-4 w-md-600px p-10">
                    <!--begin::Content-->
                    <div class="d-flex flex-center flex-column  align-items-stretch h-lg-100 w-md-400px">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
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

                                    <input type="text" placeholder="{{ __('common.email') }}" id="email"
                                        name="email" autocomplete="off"
                                        class="form-control bg-transparent"value="{{ $email ?? old('email') }}" />

                                    <!--end::Email-->
                                </div>
                                <div class="mb-10 fv-row fv-plugins-icon-container" data-kt-password-meter="true">
                                    <!--begin::Wrapper-->
                                    <div class="mb-1">
                                        <!--begin::Input wrapper-->
                                        <div class="position-relative mb-3">
                                            <input class="form-control form-control-lg bg-transparent" type="password"
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
                                        <div class="d-flex align-items-center mb-3"
                                            data-kt-password-meter-control="highlight">
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
                                    <input class="form-control form-control-lg bg-transparent" type="password"
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
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Footer-->
                        <div class="d-flex flex-stack">
                            <!--begin::Links-->
                            <div class="d-flex fw-semibold text-primary fs-base gap-5">
                                <a href="" target="_blank">Terms</a>
                                <a href="" target="_blank">Plans</a>
                                <a href="" target="_blank">Contact Us</a>
                            </div>
                            <!--end::Links-->
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--end::Javascript-->
    @push('scripts')
        <script src="{{ asset('js/auth/reset.js') }}" type="module"></script>
    @endpush
@endsection
