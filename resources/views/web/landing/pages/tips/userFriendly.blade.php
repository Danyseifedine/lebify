@extends('web.landing.layout.main')

@section('title', 'User-Friendly Interface: Tips for Designing Intuitive and Accessible Websites | Lebify')
@section('meta_description', 'Learn how to create a user-friendly interface for your website. Discover key principles of simplicity, consistency, responsiveness, accessibility, and intuitiveness in web design.')
@section('meta_keywords', 'user-friendly interface, web design, UX, UI, accessibility, responsive design, website usability')

@section('og_title', 'User-Friendly Interface - How To Create One')
@section('og_description', 'Tips for designing an intuitive and accessible website. Learn about simplicity, consistency, responsiveness, accessibility, and intuitiveness in web design.')
@section('og_image', asset('vendor/img/lebify/tips/userFriendly/user-friendly-light.svg'))
@section('og_url', url()->current())

@section('twitter_card', 'summary_large_image')
@section('twitter_title', 'User-Friendly Interface: The Key to Website Success')
@section('twitter_description', 'Discover how to create a user-friendly website interface that boosts engagement, conversions, and user satisfaction.')
@section('twitter_image', asset('vendor/img/lebify/tips/userFriendly/user-friendly-light.svg'))

@section('canonical', url()->current())

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/project/web/tips.css') }}">
    @endpush
    <style>
        [data-bs-theme="dark"] #kt_app_page {
            background-image: url(../../../vendor/img/lebify/tips/userFriendly/user-friendly-bg-dark.svg);
            background-size: 100%;
            background-position: bottom;
            background-repeat: no-repeat;
            background-clip: border-box;
        }

        [data-bs-theme="light"] #kt_app_page {
            background-image: url(../../../vendor/img/lebify/tips/userFriendly/user-friendly-bg-light.svg);
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
                                User-Friendly Interface - How To Create One. Tips for designing an intuitive and accessible
                                website
                            </a>
                            <!--end::Title-->
                            <!--begin::Container-->
                            <div class="overlay mt-12">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded theme-dark-show goal-img"
                                    style="background-image:url('{{ asset('vendor/img/lebify/tips/userFriendly/user-friendly-dark.svg') }}'); background-size: 100%; background-position: center; min-height: 600px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                </div>
                                <!--end::Image-->
                            </div>
                            <div class="overlay mt-12">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded theme-light-show goal-img"
                                    style="background-image:url('{{ asset('vendor/img/lebify/tips/userFriendly/user-friendly-light.svg') }}'); background-size: 100%; background-position: center; min-height: 600px;">
                                </div>
                                <!--end::Image-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Description-->
                        <!--begin::Title-->
                        <h1 class="text-gray-900 fw-bold mb-6" style="margin-top: 50px;">User-Friendly Interface: The Key to
                            Website Success</h1>
                        <!--end::Title-->
                        <div class="fs-5 fw-semibold text-gray-600">
                            <!--begin::Text-->
                            <p class="mb-8">
                                Creating a user-friendly interface is crucial for the success of any website. It's the
                                foundation that ensures visitors can easily navigate, understand, and interact with your
                                site. Whether you're designing an e-commerce platform, a blog, or a corporate website,
                                prioritizing user experience can significantly increase engagement, conversions, and overall
                                satisfaction.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                A user-friendly interface adheres to several key principles:
                                <span class="text-gray-800 pe-1">Simplicity, Consistency, Responsiveness, Accessibility, and
                                    Intuitiveness.</span>
                                These principles work together to create an environment where users feel comfortable and can
                                achieve their goals effortlessly.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Simplicity is about decluttering your design and focusing on what's essential. As the famous
                                designer,
                                <a target="_blank" href="https://en.wikipedia.org/wiki/Dieter_Rams"
                                    class="link-primary pe-1">Dieter Rams</a>
                                said, "Good design is as little design as possible." This doesn't mean your site should be
                                bare; rather, every element should serve a purpose and contribute to the user's journey.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Consistency in design elements, such as color schemes, typography, and button styles, helps
                                users quickly familiarize themselves with your interface. When users know what to expect,
                                they can navigate more confidently and efficiently. This consistency should extend across
                                all pages and sections of your website.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Responsiveness ensures your website functions well on all devices, from desktop computers to
                                smartphones. With mobile internet usage surpassing desktop, having a responsive design is no
                                longer optional—it's essential. This adaptability provides a seamless experience regardless
                                of the user's device.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Accessibility is about making your website usable for everyone, including people with
                                disabilities. This involves considerations like proper color contrast, alt text for images,
                                and keyboard navigation. Not only does this broaden your audience, but it's also
                                increasingly becoming a legal requirement in many jurisdictions.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-17">
                                Intuitiveness in design means creating an interface that users can understand and use
                                without needing extensive instructions. This often involves following established design
                                patterns and conventions that users are already familiar with. Remember, the best interface
                                is one that feels invisible—it doesn't get in the way of the user accomplishing their task.
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
                                        style="width: 70px; height: 70px; background-image: url('{{ asset('vendor/img/lebify/tips/userFriendly/ralph-caplen.webp') }}'); background-size: cover; background-position: center; border-radius: 50%;">
                                    </div>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <p class="text-gray-700 fw-bold text-hover-primary">Ralph Caplan</p>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Text-->
                            <div class="mb-0 fs-3">
                                <div class="text-muted fw-semibold lh-lg mb-2">
                                    “Thinking about design is hard, but not thinking about it can be disastrous.”
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
                                style="background-image:url({{ asset('vendor/img/lebify/tips/userFriendly/video-1.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=_K06Dni-RE4">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    UI Design Tutorial For Beginners</p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Antony Conboy</p>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted">4 Years Ago</span>
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
                                style="background-image:url({{ asset('vendor/img/lebify/tips/userFriendly/video-2.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=uwNClNmekGU">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    4 Foundational UI Design Principles | C.R.A.P. </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Jessy Showalter</p>
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
                                style="background-image:url({{ asset('vendor/img/lebify/tips/userFriendly/video-3.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=zHAa-m16NGk">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    What is UI vs. UX Design? </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Zero To Mastery</p>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted">1 Year Ago</span>
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
