<!DOCTYPE html>
<html data-navigation-type="default" data-navbar-horizontal-shape="default"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">

    <title>@yield('title') | {{ env('APP_NAME') }}</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Default description for ' . env('APP_NAME'))">
    <meta name="keywords" content="@yield('meta_keywords', 'keyword1, keyword2, keyword3')">
    <meta name="author" content="Dany Seifeddine">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title') | {{ env('APP_NAME') }}">
    <meta property="og:description" content="@yield('meta_description', 'Default description for ' . env('APP_NAME'))">
    <meta property="og:image" content="@yield('og_image', asset('path/to/default-og-image.jpg'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title') | {{ env('APP_NAME') }}">
    <meta property="twitter:description" content="@yield('meta_description', 'Default description for ' . env('APP_NAME'))">
    <meta property="twitter:image" content="@yield('og_image', asset('path/to/default-og-image.jpg'))">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendor/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('vendor/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('vendor/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('vendor/img/favicons/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#008382">
    <meta name="msapplication-TileImage" content="{{ asset('vendor/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#FFFFFF">

    <!-- Preload Important Resources -->
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700&display=swap"
        as="style">
    <link rel="preload" href="{{ asset('packages/iziToast/css/iziToast.min.css') }}" as="style">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('packages/iziToast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/project/components/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/project/components/footer.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/css/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/css/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/css/style.bundle.css') }}">
    @stack('styles')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body id="kt_app_body" data-kt-app-layout="light-header" data-kt-app-header-fixed="true"
    data-kt-app-toolbar-enabled="true" class="app-default">

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

    <!-- Custom Cursor -->
    <div class="custom-cursor" aria-hidden="true"></div>

    <!-- Main Content -->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <main class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <div class="mx-5">
                <!-- Navbar -->
                @include('web.landing.components.navbar')
            </div>
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        <div id="kt_app_content" class="app-content mt-5 flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container">
                                <!-- Page Content -->
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            @include('web.landing.components.footer')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('packages/iziToast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('packages/iziToast/js/iziToast.js') }}"></script>
    <script src="{{ url('vendor/js/plugins.bundle.js') }}"></script>
    <script src="{{ url('vendor/js/scripts.bundle.js') }}"></script>
    <script src="{{ url('vendor/js/datatables.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    @stack('scripts')
</body>

</html>
