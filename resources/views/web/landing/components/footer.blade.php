<footer class="footer mt-5">
    <img src="{{ asset('vendor/img/lebify/landing/dark/line-break.svg') }}" class="line-break-1 theme-dark-show w-100"
        alt="Decorative line break for dark theme">
    <img src="{{ asset('vendor/img/lebify/landing/light/line-break-light.svg') }}"
        class="line-break-1 theme-light-show w-100" alt="Decorative line break for light theme">
    <div class="footer-content">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="d-flex align-items-center gap-2">
                        <img height="50" width="50" src="{{ asset('vendor/img/logo/logo.png') }}"
                            alt="Lebify Logo">
                        <h2 class="fs-2 footer-title fw-bold p-0 m-0">Lebify</h2>
                    </div>
                    <p class="fs-5 mt-5 mb-5">We are a company dedicated to providing the best services to our
                        customers. Our mission is to deliver high-quality products and exceptional customer service.</p>
                </div>
                <div class="col-md-2"></div>
                {{-- <div class="col-md-2">
                    <h3 class="mb-5 footer-title">Quick Links</h3>
                    <nav aria-label="Footer navigation">
                        <ul class="list-unstyled">
                            <li class="mb-5 fs-4"><a href="/" title="Home">Home</a></li>
                            <li class="mb-5 fs-4"><a href="/services" title="Our Services">Services</a></li>
                            <li class="mb-5 fs-4"><a href="/contact" title="Contact Us">Contact</a></li>
                            <li class="mb-5 fs-4"><a href="/about" title="About Us">About</a></li>
                        </ul>
                    </nav>
                </div> --}}
                <!-- ... (other Quick Links sections remain unchanged) ... -->
                <div class="col-md-2">
                    <h3 class="mb-4 footer-title">Contact Us</h3>
                    <address class="fs-4">
                        <p class="mb-5"><span class="fw-bold footer-title">Email:</span> <a
                                href="mailto:support@lebify.dev">support@lebify.dev</a></p>
                        <p class="mb-5"><span class="fw-bold footer-title">Phone:</span> <a
                                href="tel:+96103004699">+961 03004699</a></p>
                        <p class="mb-5"><span class="fw-bold footer-title">Address:</span> Lebanon, Barja</p>
                    </address>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-12 text-center">
                    <p class="fs-4 fw-bold">&copy; {{ date('Y') }} Lebify. All rights reserved. Website made with ❤️
                        by <a href="https://github.com/daniseifeddine" target="_blank" rel="noopener noreferrer">Dany
                            Seifeddine</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
