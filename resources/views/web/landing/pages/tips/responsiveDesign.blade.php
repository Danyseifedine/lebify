@extends('web.landing.layout.main')

@section('title', 'Responsive Web Design: Creating Seamless Experiences Across Devices | Lebify')
@section('meta_description', 'Learn about responsive web design and how it ensures optimal viewing experiences across all devices. Discover the core principles of fluid grids, flexible images, and media queries.')
@section('meta_keywords', 'responsive design, web development, fluid grids, flexible images, media queries, mobile-friendly, SEO')

@section('og_title', 'Responsive Design: Adapting to Every Screen')
@section('og_description', 'Explore the importance of responsive web design in creating seamless user experiences across all devices, from desktops to smartphones.')
@section('og_image', asset('vendor/img/lebify/tips/responsive/responsive-light.svg'))
@section('og_url', url()->current())

@section('twitter_card', 'summary_large_image')
@section('twitter_title', 'Responsive Web Design: Adapting to Every Screen')
@section('twitter_description', 'Learn how responsive design principles create optimal viewing experiences across all devices.')
@section('twitter_image', asset('vendor/img/lebify/tips/responsive/responsive-light.svg'))

@section('canonical', url()->current())

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/project/web/tips.css') }}">
    @endpush
    <style>
        [data-bs-theme="dark"] #kt_app_page {
            background-image: url(../../../vendor/img/lebify/tips/responsive/responsive-bg-dark.svg);
            background-size: 100%;
            background-position: bottom;
            background-repeat: no-repeat;
            background-clip: border-box;
        }

        [data-bs-theme="light"] #kt_app_page {
            background-image: url(../../../vendor/img/lebify/tips/responsive/responsive-bg-light.svg);
            background-size: 100%;
            background-position: bottom;
            background-repeat: no-repeat;
            background-clip: border-box;
        }

        @media (max-width: 768px) {
            .goal-img {
                display: none !important;
            }
        }
    </style>
    <div class="mt-12">
        <!--begin::Body-->
        <div class="pb-lg-0 mt-12">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-xl-15">
                    <!--begin::Post content-->
                    <div class="mb-17">
                        <!--begin::Wrapper-->
                        <div class="mb-8">
                            <!--begin::Title-->
                            <a href="#" class="text-gray-900 text-hover-primary fs-1 fw-bold mb-3">
                                Responsive Design: Adapting to Every Screen
                            </a>
                            <!--end::Title-->
                            <!--begin::Container-->
                            <div class="overlay mt-12">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded theme-dark-show goal-img"
                                    style="background-image:url('{{ asset('vendor/img/lebify/tips/responsive/responsive-dark.svg') }}'); background-size: 100%; background-position: center; min-height: 600px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                </div>
                                <!--end::Image-->
                            </div>
                            <div class="overlay mt-12">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded theme-light-show goal-img"
                                    style="background-image:url('{{ asset('vendor/img/lebify/tips/responsive/responsive-light.svg') }}'); background-size: 100%; background-position: center; min-height: 600px;">
                                </div>
                                <!--end::Image-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Description-->
                        <!--begin::Title-->
                        <h1 class="text-gray-900 fw-bold mb-6" style="margin-top: 50px;">Responsive Web Design: Creating
                            Seamless Experiences Across Devices</h1>
                        <!--end::Title-->
                        <div class="fs-5 fw-semibold text-gray-600">
                            <!--begin::Text-->
                            <p class="mb-8">
                                Responsive design is a crucial approach in modern web development that ensures websites look
                                and function well on all devices, from desktop computers to smartphones. It's not just about
                                making a site that fits different screen sizes; it's about creating an optimal viewing and
                                interaction experience across a wide range of devices.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                The core principles of responsive design include:
                                <span class="text-gray-800 pe-1">Fluid Grids, Flexible Images, and Media Queries.</span>
                                These principles work together to create a seamless user experience regardless of the device
                                being used.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Fluid grids use relative units like percentages instead of fixed units like pixels. This
                                allows the layout to adjust dynamically to the screen size. As web design expert
                                <a target="_blank" href="https://ethanmarcotte.com/" class="link-primary pe-1">Ethan
                                    Marcotte</a>,
                                who coined the term "responsive web design," explains, "Fluid grids, flexible images, and
                                media queries are the three technical ingredients for responsive web design."
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Flexible images are designed to scale within their containing element. This ensures that
                                images don't overflow their containers on smaller screens or appear too small on larger
                                ones. It's about maintaining visual quality across all device sizes.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Media queries allow you to apply CSS styles based on device characteristics, most commonly
                                the width of the browser viewport. This enables you to create breakpoints where the layout
                                changes to better suit different screen sizes.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Implementing responsive design improves user experience by eliminating the need for
                                horizontal scrolling and resizing on smaller devices. It also positively impacts SEO, as
                                Google favors mobile-friendly websites in its search rankings.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-17">
                                Responsive design is not just a trend, but a fundamental approach to web design in our
                                multi-device world. As Luke Wroblewski, a product director at Google, puts it, "Mobile is
                                not the future, it's the now. Meet your customers in the environment of their choice, not
                                where it's convenient for you."
                            </p>
                            <!--end::Text-->
                        </div>
                        <!--end::Description-->
                        <!--begin::Block-->
                        <div class="d-flex align-items-center border-1 border-dashed card-rounded p-5 p-lg-10 mb-14">
                            <!--begin::Section-->
                            <div class="text-center flex-shrink-0 me-7 me-lg-13">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-70px symbol-circle mb-2">
                                    <div class="mx-auto d-block"
                                        style="width: 70px; height: 70px; background-image: url('{{ asset('vendor/img/lebify/tips/responsive/anita.jpg') }}'); background-size: cover; background-position: center; border-radius: 50%;">
                                    </div>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <p class="text-gray-700 fw-bold text-hover-primary">Anita Roddick</p>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Text-->
                            <div class="mb-0 fs-3">
                                <div class="text-muted fw-semibold lh-lg mb-2">
                                    “Speed, agility and responsiveness are the keys to future success.”
                                </div>
                            </div>
                            <!--end::Text-->
                        </div>
                        <!--end::Block-->
                    </div>
                    <!--end::Post content-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
            <!--begin::Section-->
            <div class="mb-17">
                <!--begin::Content-->
                <div class="d-flex flex-stack mb-5">
                    <!--begin::Title-->
                    <h3 class="text-gray-900">Related videos</h3>
                    <!--end::Title-->
                </div>
                <!--end::Content-->
                <!--begin::Separator-->
                <div class="separator separator-dashed mb-9"></div>
                <!--end::Separator-->
                <!--begin::Row-->
                <div class="row g-10">
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <!--begin::Feature post-->
                        <div class="card-xl-stretch me-md-6">
                            <!--begin::Image-->
                            <a target="__blank"
                                class="lebify-scale-up d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-200px mb-5"
                                style="background-image:url({{ asset('vendor/img/lebify/tips/responsive/video-1.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=wJlsyYmh6mM">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    What is the Importance of Responsive Website?
                                </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Ascii System</p>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted">2 Years Ago</span>
                                    <!--end::Date-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feature post-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <!--begin::Feature post-->
                        <div class="card-xl-stretch mx-md-3">
                            <!--begin::Image-->
                            <a target="__blank"
                                class="lebify-scale-up d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-200px mb-5"
                                style="background-image:url({{ asset('vendor/img/lebify/tips/responsive/video-2.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=Mco_Qfs1BgU">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    Responsive vs. Adaptive vs. Fluid Design: What's the Difference?
                                </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Kerev Design</p>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted">2 Years Ago</span>
                                    <!--end::Date-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feature post-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <!--begin::Feature post-->
                        <div class="card-xl-stretch ms-md-6">
                            <!--begin::Image-->
                            <a target="__blank"
                                class="lebify-scale-up d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-200px mb-5"
                                style="background-image:url({{ asset('vendor/img/lebify/tips/responsive/video-3.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=ZYV6dYtz4HA">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    How to Make a Website Responsive
                                </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Dani krossing</p>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted">6 Years Ago</span>
                                    <!--end::Date-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Feature post-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Section-->
            <!--begin::Section-->
            <div class="mb-17">
                <!--begin::Content-->
                <div class="d-flex flex-stack mb-5">
                    <!--begin::Title-->
                    <h3 class="text-gray-900">Others</h3>
                    <!--end::Title-->
                </div>
                <!--end::Content-->
                <!--begin::Separator-->
                <div class="separator separator-dashed mb-9"></div>
                <!--end::Separator-->
                <!--begin::Row-->
                <div class="row g-10">
                    @foreach ($selectedCards as $card)
                        <!--begin::Col-->
                        <div class="col-md-4">
                            <!--begin::Hot sales post-->
                            <div
                                class="card-xl-stretch {{ $loop->first ? 'me-md-6' : ($loop->last ? 'ms-md-6' : 'mx-md-3') }}">
                                <!--begin::Overlay-->
                                <a class="d-block overlay lebify-scale-up" data-fslightbox="lightbox-hot-sales"
                                    href="{{ $card['url'] }}">
                                    <!--begin::Image-->
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-200px"
                                        style="background-image:url({{ asset('vendor/img/lebify/tips/' . $card['image']) }})">
                                    </div>
                                    <!--end::Image-->
                                </a>
                                <!--end::Overlay-->
                                <!--begin::Body-->
                                <div class="mt-5 d-flex align-items-center justify-content-between">
                                    <!--begin::Title-->
                                    <p class="fs-4 p-0 m-0 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                        {{ $card['title'] }} </p>
                                    <!--end::Title-->
                                </div>
                                <!--end::Body-->
                                <!--begin::Description-->
                                <p class="fs-6 text-gray-600 mt-2">
                                    {{ $card['description'] }}
                                </p>
                                <!--end::Description-->
                            </div>
                            <!--end::Hot sales post-->
                        </div>
                        <!--end::Col-->
                    @endforeach
                </div>
                <!--end::Row-->
            </div>
            <!--end::Section-->
        </div>
        <!--end::Body-->
    </div>
@endsection
