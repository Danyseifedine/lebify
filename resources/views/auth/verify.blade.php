@extends('web.dashboard.layouts.auth')

@section('title', 'Verify Your Email')
@section('meta_description', 'Verify your email address to access all features of Lebify. Complete your registration process and start innovating with our cutting-edge tools.')
@section('meta_keywords', 'email verification, account activation, Lebify, digital projects, innovation, developer tools')

@section('og_title', 'Verify Your Lebify Account')
@section('og_description', 'Complete your Lebify account setup by verifying your email. Access our full range of innovative tools and services for your digital projects.')

@section('twitter_title', 'Activate Your Lebify Account - Verify Your Email')
@section('twitter_description', 'One last step! Verify your email to unlock all Lebify features. Start empowering your digital projects with our innovative tools.')

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
                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                @csrf
                                <a href=""
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="text-logo fw-bold fs-5">{{ __('actions.log_out') }}</a>
                            </form>
                            <!--begin::Form-->
                            <form class="py-20" id="verify-form" method="POST"
                                action="{{ route('verification.resend') }}">
                                @csrf

                                <!--begin::Heading-->
                                <div class="text-start mb-10">
                                    <!--begin::Title-->
                                    <h1 class="text-gray-900 mb-3 fs-3x" data-kt-translate="new-password-title">
                                        {{ __('auth.email_verification') }}</h1>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <div class="text-gray-500 fw-semibold fs-6" data-kt-translate="new-password-desc">
                                        {{ __('auth.access_features') }}
                                    </div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Actions-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Link-->
                                    <button class="btn bg-logo d-flex align-items-center justify-content-center gap-2"
                                        loading="{{ __('common.sending') }}" with-spinner="true" type="submit">
                                        <span class="ld-span">{{ __('auth.send_verification_email') }}</span>
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
        <script src="{{ asset('js/auth/verify.js') }}" type="module"></script>
    @endpush
@endsection
