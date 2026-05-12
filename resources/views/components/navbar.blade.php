<nav class="navbar navbar-expand-lg bg-primary-dark fixed-top sticky-lg-top" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-medium py-0" href="{{ route('index.view') }}">
            <img height="47" src="{{ asset('static/img/logo.svg') }}" alt="Logo {{ config('app.name') }}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav fw-medium gap-lg-3 align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#vision-and-missions">Visions & Missions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#company-values">Company Values</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#offerings">Offerings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#partners">Partners</a>
                </li>
                <li class="nav-item">
                    <div class="nav-link">
                        <a class="btn btn-sm btn-light fw-semibold px-3 d-inline-flex align-items-center gap-2 text-primary-dark contact-us-btn" href="#contact-us">
                            Contact Us
                            <i class="bi bi-arrow-right-short text-primary-dark"></i>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
@push('css')
    <style>
        .navbar {
            transition: transform 0.3s ease, opacity 0.2s ease;
            will-change: transform;
        }

        .navbar.navbar--hidden {
            transform: translateY(-100%);
        }

        .navbar.navbar--visible {
            transform: translateY(0);
        }

        @media (min-width: 992px) {
            .navbar .student-life-dropdown {
                padding-top: 11.5px !important;
                margin-top: 0 !important;
            }
        }

        .navbar .nav-item .dropdown-menu .dropdown-item {
            transition: all 0.2s ease-in-out;
        }

        .navbar .nav-item .dropdown-menu .dropdown-item:hover {
            transform: translateX(10px);
            background-color: transparent !important;
        }

        .navbar .dropdown-toggle::after {
            display: none !important;
        }

        .navbar .contact-us-btn i {
            transition: all 0.2s ease-in-out;
        }

        .navbar .contact-us-btn:hover i {
            transform: translateX(5px);
        }
    </style>
@endpush
@push('js')
    <script>
        let lastScrollY = window.scrollY;
        const navbar = document.querySelector('.navbar');
        const collapseEl = document.querySelector('#navbarNav');
        const threshold = 6;
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(() => {
                const isMenuOpen = collapseEl?.classList.contains('show');
                const hasOpenDropdown = document.querySelector('.navbar .dropdown-menu.show');
                if (isMenuOpen || hasOpenDropdown) {
                    navbar.classList.remove('navbar--hidden');
                    navbar.classList.add('navbar--visible');
                    lastScrollY = window.scrollY;
                    ticking = false;
                    return;
                }
                const currentScrollY = window.scrollY;
                if (currentScrollY > lastScrollY && currentScrollY > 80) {
                    navbar.classList.add('navbar--hidden');
                    navbar.classList.remove('navbar--visible');
                } else if (currentScrollY < lastScrollY - threshold) {
                    navbar.classList.remove('navbar--hidden');
                    navbar.classList.add('navbar--visible');
                }
                lastScrollY = currentScrollY;
                ticking = false;
            });
        });
        if (collapseEl) {
            collapseEl.addEventListener('hidden.bs.collapse', () => {
                lastScrollY = window.scrollY;
                navbar.classList.remove('navbar--hidden');
                navbar.classList.add('navbar--visible');
            });
        }
    </script>
@endpush
