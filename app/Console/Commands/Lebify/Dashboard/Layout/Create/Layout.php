<?php

namespace App\Console\Commands\Lebify\Dashboard\Layout\Create;

use Illuminate\Console\Command;

class Layout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lebify:dashboard-layout {--light-sidebar}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new dashboard layout for the application';
    /**
     * Execute the console command.
     */
    public function handle()
    {

        $fileToDelete = resource_path('views/layouts/app.blade.php');
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
            $this->info('Deleted app.blade.php from views/layouts');
        } else {
            $this->info('app.blade.php does not exist in views/layouts');
        }

        $this->info('Creating a new dashboard layout');
        $filePath = resource_path('views/layouts/dashboard.blade.php');

        if ($this->option('light-sidebar')) {
            $fileContent = <<<'HTML'
<!DOCTYPE html>
    <html data-navigation-type="default" data-navbar-horizontal-shape="default" data-bs-theme="light"
        lang="{{ str_replace('_', '-', app()->getLocale()) }}"
        dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <!-- ===============================================-->
        <!--    Document Title-->
        <!-- ===============================================-->
        <title>@yield('title') | {{ env('APP_NAME') }}</title>
        <!-- ===============================================-->
        <!--    Favicons-->
        <!-- ===============================================-->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendor/img/favicons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('vendor/img/favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('vendor/img/favicons/favicon-16x16.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('vendor/img/favicons/favicon.ico') }}">
        <meta name="msapplication-TileColor" content="#008382">
        <meta name="msapplication-TileImage" content="{{ asset('vendor/img/favicons/mstile-150x150.png') }}">
        <!-- ===============================================-->
        <!--    Package-->
        <!-- ===============================================-->
        <link rel="stylesheet" href="{{ asset('packages/iziToast/css/iziToast.min.css') }}">
        <!-- ===============================================-->
        <!--    Meta-->
        <!-- ===============================================-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="google" content="notranslate">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#FFFFFF" />
        <meta name="author" content="Dany Seifeddine">
        <meta name="robots" content="index, nofollow">
        <!-- ===============================================-->
        <!--    Stylesheets-->
        <!-- ===============================================-->

        <link rel="stylesheet" href="{{ asset('css/loading/loading.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        @if (LaravelLocalization::getCurrentLocaleDirection() === 'rtl')
        <link href="{{ url('vendor/css/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('vendor/css/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('vendor/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        @else
        <link href="{{ url('vendor/css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('vendor/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('vendor/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        @endif
        @stack('styles')
    </head>
    <!--end::Head-->
    <!--begin::Body-->

    <body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true"
        data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
        data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
        data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
        <!--begin::Theme mode setup on page load-->
        <script>
            var defaultThemeMode = "light";
            var themeMode;
            if (document.documentElement) {
                if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                    themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                    if (localStorage.getItem("data-bs-theme") !== null) {
                        themeMode = localStorage.getItem("data-bs-theme");
                    } else {
                        themeMode = defaultThemeMode;
                    }
                }
                if (themeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                }
                document.documentElement.setAttribute("data-bs-theme", themeMode);
            }

        </script>
        <!--end::Theme mode setup on page load-->
        <!--begin::App-->
        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
            <!--begin::Page-->
            <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
                <!--begin::Header-->
                @include('dashboard.components.navbar')
                <!--end::Header-->
                <!--begin::Wrapper-->
                <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                    <!--begin::Sidebar-->
                    @include('dashboard.components.sidebar')
                    <!--end::Sidebar-->
                    <!--begin::Main-->
                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        <!--begin::Content wrapper-->
                        <div class="d-flex flex-column flex-column-fluid">
                            <!--begin::Content-->
                            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                                <!--begin::Toolbar container-->
                                <div id="kt_app_toolbar_container"
                                    class="app-container container-xxl d-flex flex-stack">
                                    @yield('toolbar')
                                </div>
                            </div>
                            <!--begin::Content-->
                            <div id="kt_app_content" class="app-content flex-column-fluid">
                                <!--begin::Content container-->
                                <div id="kt_app_content_container" class="app-container container-xxl">
                                    @yield('content')
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Content wrapper-->
                        <!--begin::Footer-->
                        <div id="kt_app_footer" class="app-footer">
                            <!--begin::Footer container-->
                                @include('dashboard.components.footer')
                            <!--end::Footer container-->
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end:::Main-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>

        <script src="{{ asset('packages/iziToast/js/iziToast.min.js') }}"></script>
        <script src="{{ asset('packages/iziToast/js/iziToast.js') }}"></script>
        <script src="{{ url('vendor/js/plugins.bundle.js') }}"></script>
        <script src="{{ url('vendor/js/scripts.bundle.js') }}"></script>
        <script src="{{ url('vendor/js/datatables.bundle.js') }}"></script>
        @stack('scripts')
    </body>
    <!--end::Body-->

    </html>

HTML;
        } else {
            $fileContent = <<<'HTML'
        <!DOCTYPE html>
    <html data-navigation-type="default" data-navbar-horizontal-shape="default" data-bs-theme="light"
        lang="{{ str_replace('_', '-', app()->getLocale()) }}"
        dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <!-- ===============================================-->
        <!--    Document Title-->
        <!-- ===============================================-->
        <title>@yield('title') | {{ env('APP_NAME') }}</title>
        <!-- ===============================================-->
        <!--    Favicons-->
        <!-- ===============================================-->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendor/img/favicons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('vendor/img/favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('vendor/img/favicons/favicon-16x16.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('vendor/img/favicons/favicon.ico') }}">
        <meta name="msapplication-TileColor" content="#008382">
        <meta name="msapplication-TileImage" content="{{ asset('vendor/img/favicons/mstile-150x150.png') }}">
        <!-- ===============================================-->
        <!--    Package-->
        <!-- ===============================================-->
        <link rel="stylesheet" href="{{ asset('packages/iziToast/css/iziToast.min.css') }}">
        <!-- ===============================================-->
        <!--    Meta-->
        <!-- ===============================================-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="google" content="notranslate">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#FFFFFF" />
        <meta name="author" content="Dany Seifeddine">
        <meta name="robots" content="index, nofollow">
        <!-- ===============================================-->
        <!--    Stylesheets-->
        <!-- ===============================================-->

        <link rel="stylesheet" href="{{ asset('css/loading/loading.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        @if (LaravelLocalization::getCurrentLocaleDirection() === 'rtl')
        <link href="{{ url('vendor/css/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('vendor/css/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('vendor/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        @else
        <link href="{{ url('vendor/css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('vendor/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('vendor/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        @endif
        @stack('styles')
    </head>
    <!--end::Head-->
    <!--begin::Body-->

    <body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
        data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
        data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
        data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
        <!--begin::Theme mode setup on page load-->
        <script>
            var defaultThemeMode = "light";
            var themeMode;
            if (document.documentElement) {
                if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                    themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                    if (localStorage.getItem("data-bs-theme") !== null) {
                        themeMode = localStorage.getItem("data-bs-theme");
                    } else {
                        themeMode = defaultThemeMode;
                    }
                }
                if (themeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                }
                document.documentElement.setAttribute("data-bs-theme", themeMode);
            }

        </script>
        <!--end::Theme mode setup on page load-->
        <!--begin::App-->
        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
            <!--begin::Page-->
            <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
                <!--begin::Header-->
                @include('dashboard.components.navbar')
                <!--end::Header-->
                <!--begin::Wrapper-->
                <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                    <!--begin::Sidebar-->
                    @include('dashboard.components.sidebar')
                    <!--end::Sidebar-->
                    <!--begin::Main-->
                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        <!--begin::Content wrapper-->
                        <div class="d-flex flex-column flex-column-fluid">
                            <!--begin::Content-->
                            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                                <!--begin::Toolbar container-->
                                <div id="kt_app_toolbar_container"
                                    class="app-container container-xxl d-flex flex-stack">
                                    @yield('toolbar')
                                </div>
                            </div>
                            <!--begin::Content-->
                            <div id="kt_app_content" class="app-content flex-column-fluid">
                                <!--begin::Content container-->
                                <div id="kt_app_content_container" class="app-container container-xxl">
                                    @yield('content')
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Content wrapper-->
                        <!--begin::Footer-->
                        <div id="kt_app_footer" class="app-footer">
                            <!--begin::Footer container-->
                                @include('dashboard.components.footer')
                            <!--end::Footer container-->
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end:::Main-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>

        <script src="{{ asset('packages/iziToast/js/iziToast.min.js') }}"></script>
        <script src="{{ asset('packages/iziToast/js/iziToast.js') }}"></script>
        <script src="{{ url('vendor/js/plugins.bundle.js') }}"></script>
        <script src="{{ url('vendor/js/scripts.bundle.js') }}"></script>
        <script src="{{ url('vendor/js/datatables.bundle.js') }}"></script>
        @stack('scripts')
    </body>
    <!--end::Body-->

    </html>
HTML;
        }


        if (!file_exists($filePath)) {
            file_put_contents($filePath, $fileContent);
            $this->info('Dashboard layout created successfully.');
        } else {
            $this->info('Dashboard layout already exists.');
        }
    }
}
