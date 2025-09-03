@extends('web.dashboard.layouts.auth')

@section('title', 'Register for Lebify')
@section('meta_description', 'Join Lebify and unlock a world of free applications, APIs, and services for your digital
    projects. Create your account to access cutting-edge tools that drive innovation.')
@section('meta_keywords', 'register, sign up, create account, Lebify, digital projects, innovation, developer tools')

@section('og_title', 'Join Lebify - Empower Your Digital Projects')
@section('og_description', 'Create your Lebify account to access free applications, APIs, and services. Start innovating
    and accelerate your project success today!')

@section('twitter_title', 'Sign up for Lebify - Unlock Innovative Tools')
@section('twitter_description', 'Join Lebify to access cutting-edge tools for developers. Create your account and start
    empowering your digital projects now!')

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
                            <form class="form w-100" id="register-form" action="#">
                                <a href="{{ route('home') }}" class="btn btn-icon btn-sm btn-light-primary me-3">
                                    <i class="bi bi-arrow-left fs-2"></i>
                                </a>
                                <!--begin::Heading-->
                                <div class="text-center mb-11">
                                    <!--begin::Title-->
                                    <h1 class="text-gray-900 fw-bolder mb-3">Sign Up</h1>
                                    <!--end::Title-->
                                    <!--begin::Subtitle-->
                                    <div class="text-gray-500 fw-semibold fs-6">Create your account</div>
                                    <!--end::Subtitle=-->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Login options-->
                                <div class="row g-3 mb-9">
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <!--begin::Google link=-->
                                        <a href="{{ route('social.redirect', ['provider' => 'google']) }}"
                                            class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                            <img alt="Logo" src="{{ asset('vendor/img/lebify/auth/google.png') }}"
                                                class="h-15px me-3" />Sign in with Google</a>
                                        <!--end::Google link=-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <!--begin::Google link=-->
                                        <a href="{{ route('social.redirect', ['provider' => 'github']) }}"
                                            class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                            <i class="bi bi-github fs-2 text-black me-3 theme-light-show"></i>
                                            <i class="bi bi-github fs-2 text-white me-3 theme-dark-show"></i>Sign in
                                            with Github</a>
                                        <!--end::Google link=-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Login options-->
                                <!--begin::Separator-->
                                <div class="separator separator-content my-14">
                                    <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                                </div>
                                <!--end::Separator-->
                                <div class="mb-8">
                                    <input type="text" placeholder="Name" id="name" name="name"
                                        autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <!--begin::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Email-->
                                    <input type="text" placeholder="Email" id="email" name="email"
                                        autocomplete="off" class="form-control bg-transparent" />
                                    <!--end::Email-->
                                </div>
                                <!--end::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Password-->
                                    <input type="password" placeholder="Password" id="password" name="password"
                                        autocomplete="off" class="form-control bg-transparent" />
                                    <!--end::Password-->
                                </div>
                                <div class="fv-row mb-3">
                                    <!--begin::Password-->
                                    <input type="password" placeholder="Confirm Password" id="password_confirmation"
                                        name="password_confirmation" autocomplete="off"
                                        class="form-control bg-transparent" />
                                    <!--end::Password-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <!--begin::Link-->
                                    <a href="{{ route('password.request') }}" class="link-primary">Forgot
                                        Password ?</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Submit button-->
                                <div class="d-grid mb-10">
                                    <button type="submit" loading="Registering..." with-spinner="true" type="submit"
                                        class="btn btn-primary">
                                        <!--begin::Indicator label-->
                                        <span class="ld-span">Register</span>
                                        <!--end::Indicator label-->
                                    </button>
                                </div>
                                <!--end::Submit button-->
                                <!--begin::Sign up-->
                                <div class="text-gray-500 text-center fw-semibold fs-6">Already have an account?
                                    <a href="{{ route('login') }}" class="link-primary">Sign
                                        in</a>
                                </div>
                                <!--end::Sign up-->
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
        <script src="{{ asset('js/auth/register.js') }}" type="module"></script>
    @endpush
@endsection
