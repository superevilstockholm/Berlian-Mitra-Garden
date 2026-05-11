@extends('layouts.dashboard')
@section('title', 'Create Partner')
@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card my-0">
                <div
                    class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-2 gap-lg-5">
                    <div class="d-flex flex-column">
                        <h3 class="p-0 m-0 mb-1 fw-semibold">Create Partner</h3>
                        <p class="p-0 m-0 fw-medium text-muted">Create a new partner.</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('dashboard.master-data.partners.index') }}"
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
                    <form action="{{ route('dashboard.master-data.partners.store') }}" autocomplete="off"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="logo_file" id="imageInput" class="d-none @error('logo_file') is-invalid @enderror" accept="image/*">
                            <img src="{{ asset('static/img/no-image-placeholder.svg') }}" id="imagePreview" alt="Preview Image" class="w-100 rounded object-fit-cover border" style="max-width: 300px; height: 200px; object-position: center; cursor: pointer;">
                            <div class="mt-2 text-muted small">
                                Click on the image to choose file
                            </div>
                            <button type="button" id="removeImageBtn" class="btn btn-sm btn-danger mt-2 d-none">
                                <i class="ti ti-trash me-1"></i> Remove Image
                            </button>
                            @error('logo_file')
                                <div class="text-danger small mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="floatingInputName"
                                placeholder="Name" autocomplete="off" value="{{ old('name') }}" required autofocus>
                            <label for="floatingInputName">Name <span class="text-danger">*</span></label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="website_url" class="form-control @error('website_url') is-invalid @enderror" id="floatingInputWebsite"
                                placeholder="Website" autocomplete="off" value="{{ old('website_url') }}">
                            <label for="floatingInputWebsite">Website</label>
                            @error('website_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="floatingInputDescription"
                                placeholder="Description" autocomplete="off"  data-lenis-prevent>{{ old('description') }}</textarea>
                            <label for="floatingInputDescription">Description</label>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <select name="is_featured" id="floatingInputOrder" class="form-select @error('is_featured') is-invalid @enderror" required>
                                <option value="" disabled {{ old('is_featured', '') === '' ? 'selected' : '' }}>
                                    Select Visibility
                                </option>
                                <option value="1" {{ old('is_featured') === '1' ? 'selected' : '' }}>
                                    Visible
                                </option>
                                <option value="0" {{ old('is_featured') === '0' ? 'selected' : '' }}>
                                    Hidden
                                </option>
                            </select>
                            <label for="floatingInputOrder">
                                Visibility <span class="text-danger">*</span>
                            </label>
                            @error('is_featured')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <select name="order" id="floatingInputOrder"
                                class="form-select @error('order') is-invalid @enderror" required>
                                <option value="" disabled {{ old('order') ? '' : 'selected' }}>Select order</option>
                                @for ($i = 1; $i <= $allowedMaxOrder; $i++)
                                    <option value="{{ $i }}" {{ old('order') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <label for="floatingInputOrder">Display Order <span class="text-danger">*</span></label>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 justify-content-center px-4 rounded-pill">
                                <i class="ti ti-device-floppy me-1"></i> Save Partner
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
document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const removeBtn = document.getElementById('removeImageBtn');
    const placeholder = "{{ asset('static/img/no-image-placeholder.svg') }}";
    imagePreview.addEventListener('click', function () {
        imageInput.click();
    });
    imageInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            removeBtn.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    });
    removeBtn.addEventListener('click', function () {
        imageInput.value = '';
        imagePreview.src = placeholder;
        removeBtn.classList.add('d-none');
    });
});
</script>
@endpush
