@extends('layouts.base')
@section('title', 'Masuk')
@section('content')
    <section class="vh-100 p-0 m-0">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="d-none d-lg-block col-12 col-lg-8 px-0 mx-0">
                    <img class="w-100 h-100 object-fit-cover" style="object-position: center;" src="{{ asset('static/img/placeholder-1.webp') }}" alt="Login Placeholder Image">
                </div>
                <div class="col-12 col-sm-8 col-md-5 col-lg-4 py-4 py-lg-0 h-lg-100 d-lg-flex align-items-lg-center justify-content-lg-center">
                    <div class="card border-0 p-lg-5">
                        <div class="card-header border-0" style="background-color: transparent !important;">
                            <img class="w-100" src="{{ asset('static/img/logo.svg') }}" alt="Logo {{ config('app.name') }}">
                        </div>
                        <div class="card-body border-0">
                            <form class="p-0 m-0" action="{{ route('login.attempt') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="mb-2 fw-medium" for="email">Alamat Email</label>
                                    <div class="input-group input-group-sm">
                                        <input class="form-control" type="text" name="email" id="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-2 fw-medium" for="password">Kata Sandi</label>
                                    <div class="input-group input-group-sm">
                                        <input class="form-control" type="password" name="password" id="password" value="{{ old('password') }}" autocomplete="current-password" required>
                                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                            <i class="bi bi-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1">
                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                                <div class="cf-turnstile mb-3"
                                    data-sitekey="{{ config('services.turnstile.site_key') }}">
                                </div>
                                <button class="btn btn-sm btn-primary w-100 fw-medium" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <style>
        @media (max-width: 992px) {
            .row {
                align-items: center !important;
                justify-content: center !important;
            }
        }
    </style>
@endpush
@push('js')
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const icon = togglePassword.querySelector('i');
        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });
    </script>
@endpush
