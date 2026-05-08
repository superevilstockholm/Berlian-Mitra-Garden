@extends('layouts.dashboard')
@section('title', 'Create User')
@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card my-0">
                <div
                    class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-2 gap-lg-5">
                    <div class="d-flex flex-column">
                        <h3 class="p-0 m-0 mb-1 fw-semibold">Create User</h3>
                        <p class="p-0 m-0 fw-medium text-muted">Create a new user.</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('dashboard.master-data.users.index') }}"
                            class="btn btn-sm btn-primary d-flex align-items-center gap-2 justify-content-center px-4 rounded-pill m-0">
                            <i class="ti ti-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card my-0">
                <div class="card-body">
                    <form action="{{ route('dashboard.master-data.users.store') }}" autocomplete="off"
                        method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingInputName"
                                placeholder="Name" autocomplete="off" value="{{ old('name') }}" required autofocus>
                            <label for="floatingInputName">Name <span class="text-danger">*</span></label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInputEmail"
                                placeholder="Email" autocomplete="off" value="{{ old('email') }}" required>
                            <label for="floatingInputEmail">Email <span class="text-danger">*</span></label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror pe-5" id="floatingInputPassword" placeholder="Password" autocomplete="off" required>
                            <label for="floatingInputPassword">Password <span class="text-danger">*</span></label>
                            <button type="button" class="btn border-0 bg-transparent position-absolute top-50 end-0 translate-middle-y me-3 z-3 d-flex align-items-center" id="togglePassword">
                                <i class="ti ti-eye" id="togglePasswordIcon"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 justify-content-center px-4 rounded-pill">
                                <i class="ti ti-device-floppy me-1"></i> Save User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    const passwordInput = document.getElementById('floatingInputPassword');
    const togglePassword = document.getElementById('togglePassword');
    const togglePasswordIcon = document.getElementById('togglePasswordIcon');
    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password'
            ? 'text'
            : 'password';
        passwordInput.setAttribute('type', type);
        togglePasswordIcon.classList.toggle('ti-eye');
        togglePasswordIcon.classList.toggle('ti-eye-off');
    });
</script>
@endpush
