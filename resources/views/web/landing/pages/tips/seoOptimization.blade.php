@extends('web.landing.layout.main')

@section('title', 'SEO Optimization: Boosting Your Website\'s Visibility | Lebify')
@section('meta_description', 'Learn how to master SEO and elevate your website\'s search engine performance. Discover key strategies for keyword research, on-page optimization, content quality, technical SEO, and link building.')
@section('meta_keywords', 'SEO optimization, search engine optimization, website visibility, keyword research, on-page optimization, content quality, technical SEO, link building')

@section('og_title', 'SEO Optimization: Boosting Your Website\'s Visibility')
@section('og_description', 'Discover effective SEO techniques to improve your website\'s ranking, attract organic traffic, and increase your online presence.')
@section('og_image', asset('vendor/img/lebify/tips/seo/seo-light.svg'))
@section('og_url', url()->current())

@section('twitter_card', 'summary_large_image')
@section('twitter_title', 'SEO Optimization: Boosting Your Website\'s Visibility')
@section('twitter_description', 'Learn key SEO practices to help boost your website\'s ranking and achieve your business goals.')
@section('twitter_image', asset('vendor/img/lebify/tips/seo/seo-light.svg'))

@section('canonical', url()->current())

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/project/web/tips.css') }}">
    @endpush
    <style>
        [data-bs-theme="dark"] #kt_app_page {
            background-image: url(../../../vendor/img/lebify/tips/seo/seo-bg-dark.svg);
            background-size: 100%;
            background-position: bottom;
            background-repeat: no-repeat;
            background-clip: border-box;
        }

        [data-bs-theme="light"] #kt_app_page {
            background-image: url(../../../vendor/img/lebify/tips/seo/seo-bg-light.svg);
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
                                SEO Optimization: Boosting Your Website's Visibility
                            </a>
                            <!--end::Title-->
                            <!--begin::Container-->
                            <div class="overlay mt-12">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded theme-dark-show goal-img"
                                    style="background-image:url('{{ asset('vendor/img/lebify/tips/seo/seo-dark.svg') }}'); background-size: 100%; background-position: center; min-height: 600px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                </div>
                                <!--end::Image-->
                            </div>
                            <div class="overlay mt-12">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded theme-light-show goal-img"
                                    style="background-image:url('{{ asset('vendor/img/lebify/tips/seo/seo-light.svg') }}'); background-size: 100%; background-position: center; min-height: 600px;">
                                </div>
                                <!--end::Image-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Description-->
                        <!--begin::Title-->
                        <h1 class="text-gray-900 fw-bold mb-6" style="margin-top: 50px;">Mastering SEO: Elevate Your
                            Website's Search Engine Performance</h1>
                        <!--end::Title-->
                        <div class="fs-5 fw-semibold text-gray-600">
                            <!--begin::Text-->
                            <p class="mb-8">
                                Search Engine Optimization (SEO) is a crucial strategy for improving your website's
                                visibility in search engine results. By implementing effective SEO techniques, you can
                                attract more organic traffic, increase your online presence, and ultimately achieve your
                                business goals. This guide will walk you through key SEO practices to help boost your
                                website's ranking.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Key elements of SEO optimization include:
                                <span class="text-gray-800 pe-1">Keyword Research, On-Page Optimization, Content Quality,
                                    Technical SEO, and Link Building.</span>
                                These components work together to improve your website's relevance and authority in the eyes
                                of search engines.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Keyword research is the foundation of SEO. It involves identifying the terms and phrases
                                your target audience uses when searching for products or services like yours. Tools like
                                <a target="_blank" href="https://ads.google.com/home/tools/keyword-planner/"
                                    class="link-primary pe-1">Google Keyword Planner</a>
                                can help you discover relevant keywords with good search volume and manageable competition.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                On-page optimization refers to optimizing individual web pages to rank higher in search
                                results. This includes optimizing title tags, meta descriptions, header tags, and
                                incorporating keywords naturally into your content. Remember, while keywords are important,
                                your content should always prioritize readability and value for your audience.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Content quality is paramount in SEO. Search engines favor websites that provide valuable,
                                relevant, and original content. Regularly updating your website with high-quality content
                                not only improves your search rankings but also establishes your site as an authoritative
                                source in your industry.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Technical SEO focuses on improving the technical aspects of your website to make it easier
                                for search engines to crawl and index your content. This includes optimizing site speed,
                                ensuring mobile-friendliness, implementing a clear site structure, and using schema markup
                                to help search engines understand your content better.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-17">
                                Link building is the process of acquiring hyperlinks from other websites to your own.
                                Quality backlinks from reputable sites signal to search engines that your content is
                                valuable and trustworthy. Focus on creating shareable content and building relationships
                                within your industry to earn natural, high-quality backlinks.
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
                                        style="width: 70px; height: 70px; background-image: url('{{ asset('vendor/img/lebify/tips/seo/neil.jpg') }}'); background-size: cover; background-position: center; border-radius: 50%;">
                                    </div>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <p class="text-gray-700 fw-bold text-hover-primary">Neil Patel</p>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Text-->
                            <div class="mb-0 fs-3">
                                <div class="text-muted fw-semibold lh-lg mb-2">
                                    “No website can stand without a strong backbone. And that backbone is technical SEO.”
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
                                style="background-image:url({{ asset('vendor/img/lebify/tips/seo/video-1.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=MYE6T_gd7H0">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    What Is SEO And How Does It Work
                                </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Simplilearn</p>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted">3 Year Ago</span>
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
                                style="background-image:url({{ asset('vendor/img/lebify/tips/seo/video-2.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=sd0ypO9MTWY">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    What is SEO? </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Hexxen</p>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted">8 Years Ago</span>
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
                                style="background-image:url({{ asset('vendor/img/lebify/tips/seo/video-3.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=brvfBk97KyI">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    The NEW Way to Do SEO in 2024 (Full Guide)
                                </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Wes McDowell</p>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted">New</span>
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
