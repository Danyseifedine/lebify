@extends('web.landing.layout.main')

@section('title', 'Lebify - Turn Your Big Idea Into a Stunning Website | Professional Web Design Services')
@section('meta_description',
    'Lebify offers professional website creation services with custom designs, fast turnaround,
    and mobile-responsive solutions. Get top-notch SEO and performance for your online presence.')
@section('meta_keywords',
    'Lebify, website design, professional websites, custom web design, fast turnaround,
    mobile-responsive, SEO optimization')


@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/project/web/content.css') }}">
        <link rel="stylesheet" href="{{ asset('css/project/components/scrollbar.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('css/project/components/cursor.css') }}"> --}}
    @endpush
    <div class="section-1 position-relative">

        <div class="container mt-5 d-flex justify-content-center align-items-center">
            <p class="intro"><span class="version">Latest Release</span> Introducing Lebify services <i
                    class="bi version-arrow bi-arrow-right"></i></p>
        </div>
        <div class="container mt-5 d-flex justify-content-center flex-column align-items-center">
            <div class="titles-container d-flex flex-column align-items-center">
                <span class="title text-center">Turn your big idea into</span>
                <span class="title sub text-center">a stunning website</span>
            </div>
            <p class="sub-of-sub mt-5 text-center" style="width: 50%;">Effortlessly create professional websites with
                lightning-fast results, top-notch SEO, and performance.</p>
            <div class="d-flex mt-5 justify-content-center align-items-center">
                {{-- @guest
                    <a href="{{ route('login') }}" class="get-started p-5 mt-5 mb-5" role="button">GET STARTED</a>
                @endguest
                @auth
                    <a href="" class="get-started p-5 mt-5 mb-5" role="button">WorkPlace</a>
                @endauth --}}
                <div class="shapes" aria-hidden="true">
                    <div class="shape shape-1 position-absolute">{ }</div>
                    <div class="shape shape-2 position-absolute">( )</div>
                    <div class="shape shape-3 position-absolute">
                        <>
                    </div>
                    <div class="shape shape-4 position-absolute">{ }</div>
                    <div class="shape shape-5 position-absolute">( )</div>
                    <div class="shape shape-6 position-absolute">{ }</div>
                    <div class="shape shape-7 position-absolute">
                        <>
                    </div>
                    <div class="shape shape-8 position-absolute">{ }</div>
                    <div class="shape shape-9 position-absolute">
                        <>
                    </div>
                    <div class="shape shape-10 position-absolute">{ }</div>
                    <div class="shape shape-11 position-absolute">( )</div>
                    <div class="shape shape-12 position-absolute">
                        <>
                    </div>
                    <div class="shape shape-13 position-absolute">{ }</div>
                    <div class="shape shape-14 position-absolute">( )</div>
                    <div class="shape shape-15 position-absolute">
                        <>
                    </div>
                </div>
            </div>
            <section class="how-it-works section-2">
                <p class="how-it-works-title text-center">Transform your online presence.</p>
                <div class="how-it-works-cards d-flex justify-content-center align-items-center gap-4">
                    <div class="card">
                        <div class="card-body d-flex gap-6">
                            <i class="bi bi-check-circle fs-1"></i>
                            <span class="card-text"><span class="card-title">Custom Website Design</span> Tailored solutions
                                to match your brand and vision. We create unique designs that stand out and impress.</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body d-flex gap-6">
                            <i class="bi bi-lightning-charge fs-1"></i>
                            <span class="card-text"><span class="card-title">Fast Turnaround Time</span> Quick delivery
                                without compromising quality. Get your website up and running in no time with our efficient
                                process.</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body d-flex gap-6">
                            <i class="bi bi-phone fs-1"></i>
                            <span class="card-text"><span class="card-title">Mobile-Responsive Sites</span> Ensure your
                                website looks great on all devices. Optimized for smartphones, tablets, and desktops for a
                                seamless experience.</span>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section-3">
                <div class="container mt-5 d-flex flex-column">
                    <div class="mt-5">
                        <span class="title">Customer Advice</span><br>
                        <span class="title sub mb-5">Tips for a Successful Website</span>
                    </div>
                    <div class="row cards-row cards-row-1">
                        <div class="col-md-6 mt-12">
                            <div class="content-card">
                                <div class="d-flex flex-column gap-3">
                                    <span class="content-title">Clear Goals</span>
                                    <span class="content-text">
                                        Define the primary objectives of your website, whether it's to inform, sell
                                        products, or
                                        provide entertainment. Clear goals help guide the design and content strategy
                                        effectively.
                                    </span>
                                    <a href="{{ route('tips', 'clear-goal') }}"
                                        class="read-more d-flex align-items-center gap-2">Read More <i
                                            class="bi read-more-arrow bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-12">
                            <div class="content-card">
                                <div class="d-flex flex-column gap-3">
                                    <span class="content-title">Easy Navigation</span>
                                    <span class="content-text">
                                        Create a clear, intuitive navigation structure. Well-organized menus and logical
                                        page hierarchy help visitors find information quickly, improving user experience.
                                    </span>
                                    <a href="{{ route('tips', 'easy-navigation') }}"
                                        class="read-more d-flex align-items-center gap-2">Read More <i
                                            class="bi read-more-arrow bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row cards-row cards-row-2">
                        <div class="col-md-6 mt-12">
                            <div class="content-card">
                                <div class="d-flex flex-column gap-3">
                                    <span class="content-title">User-Friendly Interface</span>
                                    <span class="content-text">
                                        Create an intuitive interface with clear navigation and logical layout. Use familiar
                                        design patterns to enhance usability and provide a positive user experience.
                                    </span>
                                    <a href="{{ route('tips', 'user-friendly') }}"
                                        class="read-more d-flex align-items-center gap-2">Read More <i
                                            class="bi read-more-arrow bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-12">
                            <div class="content-card">
                                <div class="d-flex flex-column gap-3">
                                    <span class="content-title">Responsive Design</span>
                                    <span class="content-text">
                                        Ensure your website works well on all devices, including mobile, tablet, and
                                        desktop. A
                                        responsive design improves user experience and accessibility for all visitors.
                                    </span>
                                    <a href="{{ route('tips', 'responsive-design') }}"
                                        class="read-more d-flex align-items-center gap-2">Read More <i
                                            class="bi read-more-arrow bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row cards-row cards-row-3">
                        <div class="col-md-6 mt-12">
                            <div class="content-card">
                                <div class="d-flex flex-column gap-3">
                                    <span class="content-title">Quality Content</span>
                                    <span class="content-text">
                                        Provide valuable, relevant, and engaging content for your audience. High-quality
                                        content
                                        attracts and retains visitors, enhancing your website's effectiveness.
                                    </span>
                                    <a href="{{ route('tips', 'quality-content') }}"
                                        class="read-more d-flex align-items-center gap-2">Read More <i
                                            class="bi read-more-arrow bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-12">
                            <div class="content-card">
                                <div class="d-flex flex-column gap-3">
                                    <span class="content-title">SEO Best Practices</span>
                                    <span class="content-text">
                                        Optimize your site to rank well in search engine results. Use relevant keywords
                                        and
                                        high-quality backlinks to improve visibility and attract organic traffic.
                                    </span>
                                    <a href="{{ route('tips', 'seo-optimization') }}"
                                        class="read-more d-flex align-items-center gap-2">Read More <i
                                            class="bi read-more-arrow bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <img src="{{ asset('vendor/img/lebify/landing/dark/line-break.svg') }}"
                class="line-break-1 theme-dark-show w-100" alt="Decorative line break for dark theme">
            <img src="{{ asset('vendor/img/lebify/landing/light/line-break-light.svg') }}"
                class="line-break-1 theme-light-show w-100" alt="Decorative line break for light theme">
            <div class="section-logos">
                <div class="container">
                    <div class="logo mb-4">
                        <img height="80" src="{{ asset('vendor/img/logo/logo.png') }}" alt="Lebify logo">
                    </div>
                </div>
            </div>
            {{-- <div class="mt-5">
                <span class="title text-center mb-12">Our team</span><br>
            </div>

            <div class="team-cards mt-12 row justify-content-center align-items-center gap-4">
                <div class="card card-team-1 col-md-5 position-relative">
                    <div class="card-body d-flex flex-column gap-6 justify-content-center align-items-center text-center">
                        <img height="150" width="150" class="rounded-circle mx-auto"
                            style="filter: grayscale(100%);" src="{{ asset('vendor/img/icon/avatars/blank.png') }}"
                            alt="Dany Seifeddine">
                        <div class="d-flex flex-column gap-">
                            <span class="team-name w-full">Dany Seifeddine</span>
                            <span class="role">Full Stack Developer</span>
                        </div>
                        <div class="social-links d-flex gap-3">
                            <a href="https://www.instagram.com/danyseifeddine" target="_blank">
                                <i class="bi bi-instagram fs-1"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/danyseifeddine" target="_blank">
                                <i class="bi bi-linkedin fs-1"></i>
                            </a>
                            <a href="https://github.com/danyseifeddine" target="_blank">
                                <i class="bi bi-github fs-1"></i>
                            </a>
                        </div>
                        </span>
                    </div>
                    <a href="">
                        <div>
                            <i class="see-more bi bi-eye fs-1 position-absolute rounded-circle p-2"></i>
                        </div>
                    </a>
                </div>
                <div class="card card-team-2 col-md-5 position-relative">
                    <div class="card-body d-flex flex-column gap-6 justify-content-center align-items-center text-center">
                        <img height="150" width="150" class="rounded-circle mx-auto"
                            style="filter: grayscale(100%);" src="{{ asset('vendor/img/icon/avatars/blank.png') }}"
                            alt="Hamzah Owaidat">
                        <div class="d-flex flex-column gap-">
                            <span class="team-name w-full">Hamzah Owaidat</span>
                            <span class="role">Full Stack Developer</span>
                        </div>
                        <div class="social-links d-flex gap-3">
                            <a href="https://www.instagram.com/danyseifeddine" target="_blank">
                                <i class="bi bi-instagram fs-1"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/danyseifeddine" target="_blank">
                                <i class="bi bi-linkedin fs-1"></i>
                            </a>
                            <a href="https://github.com/danyseifeddine" target="_blank">
                                <i class="bi bi-github fs-1"></i>
                            </a>
                        </div>
                        </span>
                    </div>
                    <a href="">
                        <div>
                            <i class="see-more bi bi-eye fs-1 position-absolute rounded-circle p-2"></i>
                        </div>
                    </a>
                </div>
            </div> --}}

            <blockquote class="sub-of-sub mt-5 text-center"
                style="width: 50%; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">
                <span class="quote-mark">❝&nbsp;</span> None of you truly believes until he loves for his brother what he
                loves
                for himself.<span class="quote-mark">&nbsp;❞</span>
            </blockquote>
            <p class="quote-writer fs-1 mt-2 text-center mb-5">
                - Prophet Muhammad peace be upon him
            </p>

            <img src="{{ asset('vendor/img/lebify/landing/dark/line-break.svg') }}"
                class="line-break-2 theme-dark-show mt-5 pt-5 mb-5 w-100" alt="Decorative line break for dark theme">
            <img src="{{ asset('vendor/img/lebify/landing/light/line-break-light.svg') }}"
                class="line-break-2 theme-light-show mt-5 pt-5 mb-5 w-100" alt="Decorative line break for light theme">

            <section class="section-5 mb-5 contact-us mt-5 w-100">
                <div class="contact-us mt-5 d-flex flex-wrap justify-content-md-evenly">
                    <div class="">
                        <div class="contact-us-info d-flex flex-column">
                            <span class="contact-us-title">Reach out anytime </span><br>
                            <span class="contact-us-subtitle mb-5">we're here for you </span>
                        </div>
                        <p class="contact-us-description mt-5 pb-5 mb-5">Underlines our dedication to prompt customer
                            service and our eagerness to address any questions
                            or feedback to enhance your service experience</p>
                        <div class="available d-flex flex-column gap-4 mt-5 pt-5">
                            <div class="d-flex gap-2 align-items-center">
                                <i class="bi bi-check-circle fs-3"></i>
                                <span class="available-text">We are available 24/7</span>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <i class="bi bi-check-circle fs-3"></i>
                                <span class="available-text">Fast response time</span>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <i class="bi bi-check-circle fs-3"></i>
                                <span class="available-text">Expert support team</span>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <i class="bi bi-check-circle fs-3"></i>
                                <span class="available-text">Customer satisfaction guaranteed</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="card">
                            <div class="card-body contact-form">
                                <form id="send-message-form" action="/contact" method="POST">
                                    @csrf
                                    <div class="mb-5">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Name">
                                    </div>
                                    <div class="mb-5">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email">
                                    </div>
                                    <div class="mb-5">
                                        <textarea class="form-control" id="message" name="message" rows="7" placeholder="Message"></textarea>
                                    </div>
                                    <button
                                        class="btn btn-send-message bg-logo d-flex align-items-center justify-content-center gap-2 w-100"
                                        with-spinner="true" type="submit">
                                        <span class="ld-span text-white fw-bold">Send</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-details">
                    <div class="how-it-works section-2">
                        <div class="how-it-works-cards d-flex justify-content-center align-items-center gap-4">
                            <div class="card">
                                <div class="card-body d-flex gap-6">
                                    <i class="bi bi-envelope fs-1"></i>
                                    <span class="card-text"><span class="card-title">Message us</span>
                                        support@lebify.dev</span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body d-flex gap-6">
                                    <i class="bi bi-telephone fs-1"></i>
                                    <span class="card-text"><span class="card-title">Call us</span>
                                        +961 03004699</span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body d-flex gap-6">
                                    <i class="bi bi-geo-alt fs-1"></i>
                                    <span class="card-text"><span class="card-title">Location</span>
                                        Lebanon, Barja</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Adding shapes -->

    @push('scripts')
        <script src="{{ asset('js/web/landing/shapes.js') }}"></script>
        <script src="{{ asset('js/web/landing/cursor.js') }}"></script>
        <script src="{{ asset('js/web/landing/contact-us.js') }}" type="module"></script>
    @endpush
@endsection
