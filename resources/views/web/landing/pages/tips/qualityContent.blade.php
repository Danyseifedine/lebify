@extends('web.landing.layout.main')

@section('title', 'How to Create Quality Content: Elevating Your Website\'s Value | Lebify')
@section('meta_description', 'Learn how to create high-quality content that engages visitors, improves search engine rankings, and boosts overall website performance. Discover key principles of relevance, accuracy, originality, readability, and value-addition.')
@section('meta_keywords', 'quality content, content creation, website value, SEO, user engagement, content marketing')

@section('og_title', 'How to Create Quality Content: Elevating Your Website\'s Value')
@section('og_description', 'Discover the key principles of creating high-quality content that resonates with your audience and achieves your website\'s goals.')
@section('og_image', asset('vendor/img/lebify/tips/qualityContent/quality-content-light.svg'))
@section('og_url', url()->current())

@section('twitter_card', 'summary_large_image')
@section('twitter_title', 'Quality Content: The Foundation of a Successful Website')
@section('twitter_description', 'Learn how to create content that engages visitors, improves SEO, and boosts website performance.')
@section('twitter_image', asset('vendor/img/lebify/tips/qualityContent/quality-content-light.svg'))

@section('canonical', url()->current())

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/project/web/tips.css') }}">
    @endpush
    <style>
        [data-bs-theme="dark"] #kt_app_page {
            background-image: url(../../../vendor/img/lebify/tips/qualityContent/quality-content-bg-dark.svg);
            background-size: 100%;
            background-position: bottom;
            background-repeat: no-repeat;
            background-clip: border-box;
        }

        [data-bs-theme="light"] #kt_app_page {
            background-image: url(../../../vendor/img/lebify/tips/qualityContent/quality-content-bg-light.svg);
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
                                How to Create Quality Content: Elevating Your Website's Value
                            </a>
                            <!--end::Title-->
                            <!--begin::Container-->
                            <div class="overlay mt-12">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded theme-dark-show goal-img"
                                    style="background-image:url('{{ asset('vendor/img/lebify/tips/qualityContent/quality-content-dark.svg') }}'); background-size: 100%; background-position: center; min-height: 600px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                </div>
                                <!--end::Image-->
                            </div>
                            <div class="overlay mt-12">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded theme-light-show goal-img"
                                    style="background-image:url('{{ asset('vendor/img/lebify/tips/qualityContent/quality-content-light.svg') }}'); background-size: 100%; background-position: center; min-height: 600px;">
                                </div>
                                <!--end::Image-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Description-->
                        <!--begin::Title-->
                        <h1 class="text-gray-900 fw-bold mb-6" style="margin-top: 50px;">Quality Content: The Foundation of
                            a Successful Website</h1>
                        <!--end::Title-->
                        <div class="fs-5 fw-semibold text-gray-600">
                            <!--begin::Text-->
                            <p class="mb-8">
                                Creating quality content is essential for the success of any website. It's the cornerstone
                                that ensures visitors find value, engage with your site, and keep coming back. Whether
                                you're running a blog, an e-commerce platform, or a corporate website, prioritizing
                                high-quality content can significantly increase user engagement, improve search engine
                                rankings, and boost overall website performance.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Quality content adheres to several key principles:
                                <span class="text-gray-800 pe-1">Relevance, Accuracy, Originality, Readability, and
                                    Value-addition.</span>
                                These principles work together to create content that resonates with your audience and
                                achieves your website's goals.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Relevance is about creating content that aligns with your audience's interests and needs. As
                                content marketing expert
                                <a target="_blank" href="https://annhandley.com/" class="link-primary pe-1">Ann Handley</a>
                                says, "Good content always has an objective; it's created with intent." Understanding your
                                audience is crucial to producing relevant content that resonates.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Accuracy in your content builds trust with your audience. This means fact-checking, citing
                                reliable sources, and keeping your information up-to-date. In the digital age where
                                misinformation spreads quickly, being a reliable source of accurate information can set your
                                website apart.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Originality is key to standing out in the crowded digital space. While it's okay to draw
                                inspiration from others, your content should offer a unique perspective or approach. This
                                could be through original research, personal experiences, or innovative ideas that haven't
                                been widely discussed.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Readability ensures your content is easily digestible by your audience. This involves using
                                clear language, breaking up text with subheadings and bullet points, and using visuals to
                                support your message. Remember, even complex topics can be explained in simple terms without
                                losing their essence.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-17">
                                Value-addition is about creating content that solves problems, answers questions, or
                                provides insights that your audience can't easily find elsewhere. As Bill Gates famously
                                said, "Content is King," but it's the value within that content that truly reigns supreme.
                                Strive to make every piece of content worthwhile for your readers.
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
                                        style="width: 70px; height: 70px; background-image: url('{{ asset('vendor/img/lebify/tips/qualityContent/andy.jfif') }}'); background-size: cover; background-position: center; border-radius: 50%;">
                                    </div>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <p class="text-gray-700 fw-bold text-hover-primary">Andy Crestodina</p>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Text-->
                            <div class="mb-0 fs-3">
                                <div class="text-muted fw-semibold lh-lg mb-2">
                                    “It’s not the best content that wins. It’s the best-promoted content that wins.” </div>
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
                                style="background-image:url({{ asset('vendor/img/lebify/tips/qualityContent/video-1.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=BBgL3ERSmdk">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    How to Measure the Quality of Your Content
                                </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">GaryVee Video Experience</p>
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
                                style="background-image:url({{ asset('vendor/img/lebify/tips/qualityContent/video-2.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=gRZ42CJ3maE">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    How to Create Quality Content For Your Website
                                </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Lead Optimize</p>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted">5 Years Ago</span>
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
                                style="background-image:url({{ asset('vendor/img/lebify/tips/qualityContent/video-3.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=WgXU7XAZYmQ">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    Why is THIS the Perfect Homepage? </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Wes McDowell</p>
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
