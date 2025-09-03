@extends('web.landing.layout.main')

@section('title', 'Clear Goals: How To Set and Achieve Objectives for Your Website | Lebify')
@section('meta_description', 'Learn how to set clear goals for your website and achieve them. Discover the SMART framework for goal-setting and tips for measuring success in web development.')
@section('meta_keywords', 'clear goals, website objectives, SMART goals, web development, goal setting, website success')

@section('og_title', 'Clear Goals - How To Achieve Them')
@section('og_description', 'Tips for setting and reaching clear objectives for your website. Learn about the SMART framework and how to measure your website\'s success.')
@section('og_image', asset('vendor/img/lebify/tips/clearGoal/mind-map-light.svg'))
@section('og_url', url()->current())

@section('twitter_card', 'summary_large_image')
@section('twitter_title', 'Clear Goals: The Key to Website Success')
@section('twitter_description', 'Discover how setting clear goals can drive your website\'s success. Learn about SMART objectives and goal measurement.')
@section('twitter_image', asset('vendor/img/lebify/tips/clearGoal/mind-map-light.svg'))

@section('canonical', url()->current())

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/project/web/tips.css') }}">
    @endpush
    <style>
        [data-bs-theme="dark"] #kt_app_page {
            background-image: url(../../../vendor/img/lebify/tips/clearGoal/dark-clear-goal.svg);
            background-size: 100%;
            background-position: bottom;
            background-repeat: no-repeat;
            background-clip: border-box;
        }

        [data-bs-theme="light"] #kt_app_page {
            background-image: url(../../../vendor/img/lebify/tips/clearGoal/light-clear-goal.svg);
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
                                Clear Goals - How To Achieve Them. Tips for setting and reaching clear objectives
                            </a>
                            <!--end::Title-->
                            <!--begin::Container-->
                            <div class="overlay mt-12">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded theme-dark-show goal-img"
                                    style="background-image:url('{{ asset('vendor/img/lebify/tips/clearGoal/mind-map-dark.svg') }}'); background-size: 100%; background-position: center; min-height: 600px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                </div>
                                <!--end::Image-->
                            </div>
                            <div class="overlay mt-12">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded theme-light-show goal-img"
                                    style="background-image:url('{{ asset('vendor/img/lebify/tips/clearGoal/mind-map-light.svg') }}'); background-size: 100%; background-position: center; min-height: 600px;">
                                </div>
                                <!--end::Image-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Description-->
                        <!--begin::Title-->
                        <h1 class="text-gray-900 fw-bold mb-6" style="margin-top: 50px;">Clear Goals: The Key to Website
                            Success</h1>
                        <!--end::Title-->
                        <div class="fs-5 fw-semibold text-gray-600">
                            <!--begin::Text-->
                            <p class="mb-8">
                                Setting clear goals is the foundation of success in any endeavor, and website development is
                                no exception.
                                Whether you're creating a personal blog, an e-commerce platform, or a corporate website,
                                having well-defined
                                objectives can significantly increase your chances of achieving what you desire. Clear goals
                                provide direction,
                                motivation, and a benchmark for measuring progress in the digital realm.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                There's a popular acronym in goal-setting that applies perfectly to website development:
                                <span class="text-gray-800 pe-1">"SMART - Specific, Measurable, Achievable, Relevant, and
                                    Time-bound."</span>
                                This framework helps ensure that your website goals are not just wishes, but actionable
                                plans that drive real results.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                When setting goals for your website, be specific about what you want to achieve. Vague goals
                                like "improve our online presence"
                                are hard to act on. Instead, try something like

                                <a target="__blank"
                                    href="https://www.quora.com/How-can-I-increase-traffic-to-my-website-by-10x-within-6-months"
                                    class="link-primary pe-1">"increase website traffic by 10x within six
                                    months"</a>
                                or "boost online sales conversion rate by 25% in the next quarter." These goals are
                                specific, measurable, and have a time frame,
                                making them much more likely to be achieved.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Clear goals for your website serve multiple purposes. Firstly, they provide a roadmap for
                                development, helping you
                                prioritize features and functionalities. If your goal is to increase e-commerce sales, for
                                instance, you'll know to
                                focus on optimizing your product pages and checkout process. Secondly, clear goals help in
                                resource allocation,
                                ensuring that your time and budget are spent on elements that directly contribute to your
                                objectives.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-8">
                                Moreover, having clear website goals facilitates better communication with stakeholders,
                                whether they're clients,
                                team members, or investors. It allows everyone involved to understand the purpose of the
                                website and work
                                cohesively towards achieving it. Clear goals also make it easier to measure success and make
                                data-driven decisions
                                for continuous improvement.
                            </p>
                            <!--end::Text-->
                            <!--begin::Text-->
                            <p class="mb-17">
                                Remember, setting clear goals for your website is just the beginning. The real work lies in
                                consistent effort and
                                regular review of your progress. Use analytics tools to track your website's performance
                                against your goals.
                                Break down your larger goals into smaller, manageable tasks or milestones. This approach not
                                only makes the
                                overall goal less daunting but also provides frequent wins to keep you and your team
                                motivated. Don't be afraid
                                to adjust your goals as circumstances change or you gain new insights from user behavior. In
                                the dynamic world
                                of web development, flexibility combined with clear direction is key to long-term success.
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
                                        style="width: 70px; height: 70px; background-image: url('{{ asset('vendor/img/lebify/tips/clearGoal/zig.jpg') }}'); background-size: cover; background-position: center; border-radius: 50%;">
                                    </div>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <p class="text-gray-700 fw-bold text-hover-primary">Zig Ziglar</p>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Text-->
                            <div class="mb-0 fs-3">
                                <div class="text-muted fw-semibold lh-lg mb-2">
                                    “I don't care how much power, brilliance or energy you have, if you don't harness it and
                                    focus it on a specific target, and hold it there, you're never going to accomplish as
                                    much as your ability warrants.”
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
                                style="background-image:url({{ asset('vendor/img/lebify/tips/clearGoal/video-1.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=BQbufwSqxpU">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    How to set clear goals</p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Struthless</p>
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
                                style="background-image:url({{ asset('vendor/img/lebify/tips/clearGoal/video-2.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=bTzTZXKkVvQ">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    Setting goals for your website (and why it matters) </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">Google search central</p>
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
                        <div class="card-xl-stretch ms-md-6">
                            <!--begin::Image-->
                            <a target="__blank"
                                class="lebify-scale-up d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-200px mb-5"
                                style="background-image:url({{ asset('vendor/img/lebify/tips/clearGoal/video-3.PNG') }})"
                                data-fslightbox="lightbox-video-tutorials"
                                href="https://www.youtube.com/watch?v=aK0CnpcIzxw">
                            </a>
                            <!--end::Image-->
                            <!--begin::Body-->
                            <div class="m-0">
                                <!--begin::Title-->
                                <p class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                    Have A Clear Website Goal Or Focus </p>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="fs-6 fw-bold">
                                    <!--begin::Author-->
                                    <p class="text-gray-700 text-hover-primary">The online buddy</p>
                                    <!--end::Author-->
                                    <!--begin::Date-->
                                    <span class="text-muted">1 Month Ago</span>
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
