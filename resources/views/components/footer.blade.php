<footer data-bs-theme="dark" class="position-relative mt-30px">
    <div class="position-absolute z-2 w-100 top-0 start-0" style="transform: translateY(-100%);">
        <div class="d-flex align-items-start">
            <div class="bg-primary-dark flex-grow-1" style="height: 30px;"></div>
            <div class="container d-flex p-0" style="flex: 0 0 auto; width: 100%;">
                <div class="bg-primary-dark" style="flex: 2; height: 30px;"></div>
                <div class="bg-primary-dark" style="width: 30px; height: 30px; border-top-right-radius: 100%;"></div>
                <div class="bg-primary-dark" style="width: 30px; height: 30px; border-top-left-radius: 100%;"></div>
                <div class="bg-primary-dark" style="flex: 1; height: 30px;"></div>
            </div>
            <div class="bg-primary-dark flex-grow-1" style="height: 30px;"></div>
        </div>
    </div>
    <div class="bg-primary-dark py-30px">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7 mb-4" id="footer-about">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <a class="text-decoration-none" href="{{ route('index.view') }}">
                                <img class="d-block" src="{{ asset('static/img/logo.svg') }}" alt="Logo {{ config('app.name') }}" height="60">
                            </a>
                        </div>
                        <div class="col-12 reveal">
                            <b>{{ config('app.name') }}</b> is an Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut quo eum blanditiis.
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 mb-4" id="footer-route-index">
                    <h6 class="text-uppercase mb-3 text-white h5 text-decoration-none d-block">Table of contents</h6>
                    <div class="d-flex flex-column gap-1 reveal">
                        <div class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="#visions-and-missions">Visions & Missions</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="#company-values">Company Values</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="#offerings">Offerings</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="#partners">Partners</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <span class="d-block text-center fs-09">
                        Copyright &copy; {{ date('Y') }} <b>{{ config('app.name') }}</b>. All rights reserved.
                    </span>
                </div>
            </div>
        </div>
    </div>
</footer>
@push('css')
    <style>
        footer .nav-item .nav-link {
            transition: all 0.2s ease-in-out;
        }
        footer .nav-item:not(.social-links) .nav-link:hover {
            transform: translateX(10px);
        }
    </style>
@endpush
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initReveal('#footer-route-index .reveal', 100);
            initReveal('#footer-about .reveal', 100);
        });
        function initReveal(selector, delay = 100) {
            const items = document.querySelectorAll(selector);
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    const index = [...items].indexOf(entry.target);
                    setTimeout(() => {
                        entry.target.classList.add('show');
                    }, index * delay);
                    observer.unobserve(entry.target);
                });
            }, {
                threshold: 0.15
            });
            items.forEach(item => observer.observe(item));
        }
    </script>
@endpush
