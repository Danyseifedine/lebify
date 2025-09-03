@extends('web.dashboard.layouts.auth')

@section('title', 'Reset Password')
@section('meta_description', 'Forgot your password? No worries! Reset your Lebify account password easily. We\'ll send you instructions to get you back on track.')
@section('meta_keywords', 'password reset, forgot password, account recovery, Lebify, digital projects, innovation')

@section('og_title', 'Reset Your Lebify Password')
@section('og_description', 'Forgot your password? We\'ve got you covered. Reset your Lebify account password and regain access to our innovative tools and services.')

@section('twitter_title', 'Recover Your Lebify Account - Reset Password')
@section('twitter_description', 'Lost access to your Lebify account? No problem! Reset your password and get back to empowering your digital projects with our cutting-edge tools.')

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
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">It's Okay, We've Got You Covered!</h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        No worries! It happens to the best of us.
                        <br />Enter your email address below and we'll send you instructions
                        <br />to reset your password and get you back on track.
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
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <!--begin::Form-->
                            <form class="py-10" method="POST" action="{{ route('password.email') }}" id="send-email-form">
                                <a href="{{ url('/') }}" class="btn mb-12 btn-icon btn-sm btn-light-primary me-3">
                                    <i class="bi bi-arrow-left fs-2"></i>
                                </a>
                                @csrf
                                <!--begin::Heading-->
                                <div class="text-start mb-10">
                                    <!--begin::Title-->
                                    <h1 class="text-gray-900 mb-3 fs-2x">{{ __('auth.forget_password') }}</h1>
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
                                    <input type="text" placeholder="{{ __('common.email') }}" id="email"
                                        name="email" autocomplete="off" class="form-control bg-transparent" />
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
                                    </div>
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
        <script src="{{ asset('js/auth/email.js') }}" type="module"></script>
    @endpush
@endsection
