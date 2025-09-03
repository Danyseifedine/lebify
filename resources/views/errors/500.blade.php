<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-navigation-type="default" data-navbar-horizontal-shape="default" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="500 Internal Server Error - We're sorry, but something went wrong on our end.">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="Dany Seifeddine">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>500 Internal Server Error | {{ env('APP_NAME') }}</title>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="500 Internal Server Error | {{ env('APP_NAME') }}">
    <meta property="og:description" content="We're sorry, but something went wrong on our end. Our team is working to resolve the issue.">
    <meta property="og:image" content="{{ asset('vendor/img/errors/error-page.svg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="500 Internal Server Error | {{ env('APP_NAME') }}">
    <meta property="twitter:description" content="We're sorry, but something went wrong on our end. Our team is working to resolve the issue.">
    <meta property="twitter:image" content="{{ asset('vendor/img/errors/error-page.svg') }}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendor/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('vendor/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('vendor/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('vendor/img/favicons/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#008382">
    <meta name="msapplication-TileImage" content="{{ asset('vendor/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#FFFFFF">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('packages/iziToast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loading/loading.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700&display=swap">
    <link rel="stylesheet" href="{{ url('vendor/css/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/css/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/css/style.bundle.css') }}">
    @stack('styles')
</head>

<body id="body" class="app-default" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px"
    data-kt-name="metronic">
    <script>
        let defaultThemeMode = "dark";
        let themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="d-flex flex-column flex-center flex-column-fluid"
            style="background-image: url({{ asset('vendor/img/errors/error-page.svg') }}) ; background-size:cover; background-position: center; background-repeat: no-repeat;">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center text-center p-6">
                <div class="card w-lg-850px py-8">
                    <div class="card-body py-12 py-lg-20">
                        <h1 class="fw-bolder fs-2hx text-logo mb-4">500 - Internal Server Error</h1>
                        <div class="fw-semibold fs-5 text-gray-600 mb-4">
                            We're sorry, but something went wrong on our end.
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500 mb-3">
                            This error could be caused by:
                            <ul class="list-unstyled mt-2">
                                <li>A temporary glitch in our server</li>
                                <li>High traffic volume</li>
                                <li>Ongoing maintenance or updates</li>
                                <li>An unexpected system error</li>
                            </ul>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500 mb-3">
                            What you can try:
                            <ul class="list-unstyled mt-2">
                                <li>Refresh the page</li>
                                <li>Clear your browser cache and cookies</li>
                                <li>Try again in a few minutes</li>
                                <li>Check our status page for any known issues</li>
                            </ul>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500 mb-5">
                            We've been notified of this issue and our team is working to resolve it.
                            If the problem persists, please contact our support team at
                            <a href="mailto:lebify@gmail.com" class="text-logo">lebify@gmail.com</a>.
                        </div>
                        <div class="mb-0">
                            <a href="{{ url('/') }}" class="btn btn-lg bg-logo me-3">Return to Homepage</a>
                            <a href="#" onclick="location.reload();" class="btn btn-lg bg-logo">Retry This
                                Page</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Content-->
        </div>
    </div>
    <script src="{{ asset('packages/iziToast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('packages/iziToast/js/iziToast.js') }}"></script>
    <script src="{{ url('vendor/js/plugins.bundle.js') }}"></script>
    <script src="{{ url('vendor/js/scripts.bundle.js') }}"></script>
    <script src="{{ url('vendor/js/datatables.bundle.js') }}"></script>
    @stack('scripts')
</body>

</html>
