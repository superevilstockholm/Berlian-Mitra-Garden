@extends('layouts.base')
@section('title', 'Beranda')
@section('content')
    <section id="vision-and-missions">
        <div class="position-relative pb-60px pb-lg-90px pt-30px pt-lg-60px" id="vision">
            <div class="container">
                <div class="row g-4 g-lg-5">
                    <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                        <h1 class="display-6 fw-bold mb-0 d-flex align-items-center text-primary">
                            <span class="bg-primary d-block me-3 me-lg-4"
                                style="width: 23px; height: 23px; transform: rotate(45deg);"></span>
                            Our Vision
                        </h1>
                    </div>
                    <div class="col-12 col-lg-6">
                        @foreach ($visions as $vision)
                            <p class="fs-5 text-secondary mb-3 reveal">
                                {{ $vision->content }}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="position-absolute z-2 w-100 top-100 start-0" style="transform: translateY(-100%);">
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
        </div>
        <div class="position-relative bg-primary-dark pb-60px pb-lg-90px pt-30px pt-lg-60px" id="missions">
            <div class="container">
                <div class="row g-4 g-lg-5">
                    <div class="col-12 col-lg-7">
                        <ul class="list-unstyled">
                            @foreach ($missions as $mission)
                                <li class="text-white mb-3 d-flex align-items-start reveal">
                                    <span class="me-3 mt-2" style="width: 8px; height: 8px; background-color: white; transform: rotate(45deg); flex-shrink: 0;"></span>
                                    <span class="fs-5">{{ $mission->content }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 col-lg-5 mb-4 mb-lg-0">
                        <h1 class="display-6 fw-bold mb-0 d-flex align-items-center text-white">
                            <span class="bg-white d-block me-3 me-lg-4"
                                style="width: 23px; height: 23px; transform: rotate(45deg);"></span>
                            Our Missions
                        </h1>
                    </div>
                </div>
            </div>
            <div class="position-absolute z-2 w-100 top-100 start-0" style="transform: translateY(-100%);">
                <div class="d-flex align-items-start">
                    <div class="bg-body flex-grow-1" style="height: 30px;"></div>
                    <div class="container d-flex p-0" style="flex: 0 0 auto; width: 100%;">
                        <div class="bg-body" style="flex: 2; height: 30px;"></div>
                        <div class="bg-body" style="width: 30px; height: 30px; border-top-right-radius: 100%;"></div>
                        <div class="bg-body" style="width: 30px; height: 30px; border-top-left-radius: 100%;"></div>
                        <div class="bg-body" style="flex: 1; height: 30px;"></div>
                    </div>
                    <div class="bg-body flex-grow-1" style="height: 30px;"></div>
                </div>
            </div>
        </div>
    </section>
    <section id="contact-us">
        <div class="position-relative pb-60px pb-lg-90px pt-30px pt-lg-60px" id="contact-form">
            <div class="container">
                <div class="row g-4 g-lg-5">
                    <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                        <h1 class="display-6 fw-bold mb-0 d-flex align-items-center text-primary">
                            <span class="bg-primary d-block me-3 me-lg-4"
                                style="width: 23px; height: 23px; transform: rotate(45deg);"></span>
                            Let Us Assist You
                        </h1>
                    </div>
                    <div class="col-12 col-lg-6">
                        <form autocomplete="off" class="p-0 m-0" action="{{ route('contact.attempt') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3 reveal">
                                <label for="name" class="form-label fw-medium mb-0">Full Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm border-0 border-bottom rounded-0 bg-transparent"
                                    id="name" name="name" value="{{ old('name') }}" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-3 reveal">
                                <label for="email" class="form-label fw-medium mb-0">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-sm border-0 border-bottom rounded-0 bg-transparent"
                                    id="email" name="email" value="{{ old('email') }}" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-3 reveal">
                                <label for="phone" class="form-label fw-medium mb-0">Phone</label>
                                <input type="text" class="form-control form-control-sm border-0 border-bottom rounded-0 bg-transparent"
                                    id="phone" name="phone" value="{{ old('phone') }}" placeholder="+62" autocomplete="off">
                            </div>
                            <div class="form-group mb-3 reveal">
                                <label for="message" class="form-label fw-medium mb-0">Message <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control form-control-sm border-0 border-bottom rounded-0 bg-transparent" id="message" name="message"
                                    autocomplete="off" required>{{ old('message') }}</textarea>
                            </div>
                            <div class="cf-turnstile mb-3"
                                data-sitekey="{{ config('services.turnstile.site_key') }}">
                            </div>
                            <button class="btn btn-sm btn-primary-dark w-100 reveal" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="position-absolute z-2 w-100 top-100 start-0" style="transform: translateY(-100%);">
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
        </div>
        <div class="position-relative bg-primary-dark pb-60px pb-lg-90px pt-30px pt-lg-60px" id="contact-map">
            <div class="container">
                <div class="row g-4 g-lg-5 flex-lg-row-reverse">
                    <div class="col-12 col-lg-4">
                        <h1 class="display-6 fw-bold mb-0 d-flex align-items-center text-white">
                            <span class="bg-white d-block me-3 me-lg-4"
                                style="width: 23px; height: 23px; transform: rotate(45deg);"></span>
                            Our Location
                        </h1>
                    </div>
                    <div class="col-12 col-lg-8" style="height: 450px;">
                        <iframe class="w-100 h-100 border-0 rounded-3 reveal" src="https://www.google.com/maps/embed?pb=!1m17!1m11!1m3!1d412.5293559585723!2d106.5954284808319!3d-6.219230374033017!2m2!1f0!2f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f9211034996f%3A0xfca2c1608111540c!2sPT.%20Penukal%20Integritas%20Indonesia!5e1!3m2!1sid!2sid!4v1778514811985!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="position-absolute z-2 w-100 top-100 start-0" style="transform: translateY(-100%);">
                <div class="d-flex align-items-start">
                    <div class="bg-body flex-grow-1" style="height: 30px;"></div>
                    <div class="container d-flex p-0" style="flex: 0 0 auto; width: 100%;">
                        <div class="bg-body" style="flex: 2; height: 30px;"></div>
                        <div class="bg-body" style="width: 30px; height: 30px; border-top-right-radius: 100%;"></div>
                        <div class="bg-body" style="width: 30px; height: 30px; border-top-left-radius: 100%;"></div>
                        <div class="bg-body" style="flex: 1; height: 30px;"></div>
                    </div>
                    <div class="bg-body flex-grow-1" style="height: 30px;"></div>
                </div>
            </div>
        </div>
        <div class="pb-30px pb-lg-60px pt-30px pt-lg-60px" id="contact-option">
            <div class="container">
                <div class="row g-4 g-lg-5">
                    <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                        <h1 class="display-6 fw-bold mb-0 d-flex align-items-center text-primary">
                            <span class="bg-primary d-block me-3 me-lg-4"
                                style="width: 23px; height: 23px; transform: rotate(45deg);"></span>
                                Get In Touch
                        </h1>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12 d-flex align-items-start mb-4 reveal">
                                <i class="bi bi-envelope fs-1 py-0 my-0"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h5 class="mb-0 fw-bold ff-inter text-uppercase">Email</h5>
                                    <p class="mb-0 fw-medium ff-inter">cvberlianmitragarden@gmail.com</p>
                                </div>
                            </div>
                            <div class="col-12 d-flex align-items-start mb-4 reveal">
                                <i class="bi bi-telephone fs-1 py-0 my-0"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h5 class="mb-0 fw-bold ff-inter text-uppercase">Telephone</h5>
                                    <p class="mb-0 fw-medium ff-inter">021-5566-7891</p>
                                </div>
                            </div>
                            <div class="col-12 d-flex align-items-start mb-4 reveal">
                                <i class="bi bi-phone fs-1 py-0 my-0"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h5 class="mb-0 fw-bold ff-inter text-uppercase">Mobile Phone</h5>
                                    <p class="mb-0 fw-medium ff-inter">+62 812-9384-2443</p>
                                </div>
                            </div>
                            <div class="col-12 d-flex align-items-start reveal">
                                <i class="bi bi-geo-alt fs-1 py-0 my-0"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h5 class="mb-0 fw-bold ff-inter text-uppercase">Address</h5>
                                    <p class="mb-0 fw-medium ff-inter">Ruko Mutiara Karawaci Blok C NO. 19, Kel. Bencongan Indah, Kec. Kelapa Dua, Kab. Tangerang, Provinsi Banten 15811</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <style>
        input,
        input:hover,
        input:focus,
        input:active,
        textarea,
        textarea:hover,
        textarea:focus,
        textarea:active {
            -webkit-box-shadow: 0 0 0 0 transparent inset !important;
            box-shadow: 0 0 0 0 transparent inset !important;
            color: var(--bs-body-color) !important;
        }
        html[data-bs-theme="dark"] .border-0 {
            border: none !important;
        }
        html[data-bs-theme="dark"] .bg-transparent {
            background-color: transparent !important;
        }
        html[data-bs-theme="dark"] .border-bottom {
            border-bottom: 1px solid rgba(var(--bs-body-color-rgb), 0.1) !important;
        }
    </style>
@endpush
@push('js')
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initReveal('#vision .reveal', 100);
            initReveal('#missions .reveal', 100);
            initReveal('#contact-form .reveal', 100);
            initReveal('#contact-map .reveal', 100);
            initReveal('#contact-option .reveal', 150);
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
