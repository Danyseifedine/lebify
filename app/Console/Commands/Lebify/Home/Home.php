<?php

namespace App\Console\Commands\Lebify\Home;

use Illuminate\Console\Command;

class Home extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lebify:home';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the home page';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $homePagePath = resource_path('views/home.blade.php');
        $newContent = <<<'HTML'
    <!DOCTYPE html>
    <html data-navigation-type="default" data-navbar-horizontal-shape="default" data-bs-theme="light"
        lang="{{ str_replace('_', '-', app()->getLocale()) }}"
        dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />

        <link
            href="https://fonts.googleapis.com/css2?family=Playwrite+DE+Grund:wght@100..400&family=Playwrite+MX:wght@100..400&family=Playwrite+US+Modern:wght@100..400&display=swap"
            rel="stylesheet">
        <title>LEBIFY</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#FFFFFF" />
        <meta name="author" content="Dany Seifeddine">
        <meta name="robots" content="index, nofollow">


        <link href="{{ url('vendor/css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('vendor/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('vendor/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <!--end::Head-->
    <!--begin::Body-->

    <body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
        data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
        data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
        data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
        <!--begin::App-->
        <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
            <h1 class="display-1 mb-5 animate__animated animate__fadeInDown">LEBIFY</h1>
            <a href="{{ route('dashboard.index') }}" class="btn btn-primary btn-lg mb-5 animate__animated animate__fadeInUp">Dashboard</a>
            <div class="social-links animate__animated animate__fadeIn">
                <a href="https://www.linkedin.com/in/dany-seifeddine-ab6558247/" class="social-link">LinkedIn</a>
                <a href="https://www.instagram.com/danny__seifeddine/" class="social-link">Instagram</a>
                <a href="https://github.com/daniseifeddine" class="social-link">GitHub</a>
                <a href="https://lebify.com" class="social-link">Lebify.com</a>
                <a href="{{ route('logout') }}" class="social-link">Logout</a>
            </div>

            <style>
                body {
                    background-image: url('{{ asset('vendor/img/bg/home-bg.png') }}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    font-family: 'Playwrite US Modern', sans-serif;
                    background-color: #f9f9f9c8 !important;
                }

                @keyframes backgroundAnimation {
                    0% {
                        background-size: 200%;
                    }

                    100% {
                        background-size: 100%;
                    }
                }

                .container {
                    padding: 2rem;
                }


                h1 {
                    font-weight: lighter !important;
                    color: #1e1e1e;
                    letter-spacing: 30px !important;
                    font-size: 100px !important;
                }

                .btn-primary {
                    background-color: #007bff;
                    border: none;
                    padding: 20px 50px;
                    font-size: 1.5rem;
                    font-weight: lighter !important;
                    text-transform: uppercase;
                    letter-spacing: 2px;
                    transition: background-color 0.3s ease, transform 0.3s ease;
                }

                .btn-primary:hover {
                    background-color: #0056b3;
                    transform: translateY(-5px);
                }

                .social-links {
                    display: flex;
                    justify-content: center;
                    flex-wrap: wrap;
                    margin-top: 3rem;
                }

                .social-link {
                    font-weight: 400 !important;
                    margin: 1rem 40px;
                    color: #555;
                    text-decoration: none;
                    transition: color 0.3s ease, transform 0.3s ease;
                    font-size: 1.8rem;
                }

                .social-link:hover {
                    color: #007bff;
                    transform: translateY(-3px);
                }

                @media (min-width: 900px) {
                    body {
                        animation: backgroundAnimation 1s alternate !important;
                    }
                }

                @media (max-width: 500px) {
                    h1 {
                        letter-spacing: 10px !important;
                        font-size: 50px !important;
                    }
                }
            </style>
        </div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    </body>
    <!--end::Body-->

    </html>
HTML;

        file_put_contents($homePagePath, $newContent);
        $this->info('Home page content updated successfully.');
    }
}
