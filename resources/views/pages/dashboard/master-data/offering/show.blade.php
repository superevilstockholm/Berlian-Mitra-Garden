@extends('layouts.dashboard')
@section('title', 'Offering Details')
@section('content')
    <x-alerts :errors="$errors" />
    <div class="row mb-4">
        <div class="col">
            <div class="card my-0">
                <div
                    class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-2 gap-lg-5">
                    <div class="d-flex flex-column">
                        <h3 class="p-0 m-0 mb-1 fw-semibold">Offering Details</h3>
                        <p class="p-0 m-0 fw-medium text-muted">View detailed information about this offering.</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('dashboard.master-data.offerings.index') }}"
                            class="btn btn-sm btn-primary d-flex align-items-center gap-2 justify-content-center px-4 rounded-pill m-0">
                            <i class="ti ti-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-3">Offering Details</h4>
                    <div class="row mb-3">
                        <div class="col-12 fw-medium">
                            <img src="{{ $offering->image_url }}" alt="{{ $offering->name }} {{ $offering->type?->label() }} Image" class="w-100 rounded object-fit-cover border" style="max-width: 300px; height: 200px; object-position: center;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Name</div>
                        <div class="col-md-8 fw-medium">{{ $offering->name ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Description</div>
                        <div class="col-md-8 fw-medium">{{ $offering->description ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Type</div>
                        <div class="col-md-8 fw-medium">{{ $offering->type->label() ?? '-' }}</div>
                    </div>
                    <h4 class="card-title fw-semibold mt-4 mb-3">System Information</h4>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Offering ID</div>
                        <div class="col-md-8 fw-medium">{{ $offering->id ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Created At</div>
                        <div class="col-md-8 fw-medium">{{ $offering->created_at?->format('d M Y H:i:s') ?? '-' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-muted">Updated At</div>
                        <div class="col-md-8 fw-medium">{{ $offering->updated_at?->format('d M Y H:i:s') ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card my-0">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-3">Quick Actions</h4>
                    <a href="{{ route('dashboard.master-data.offerings.edit', $offering->id) }}"
                        class="btn btn-warning d-flex align-items-center gap-2 justify-content-center w-100 mb-2">
                        <i class="ti ti-pencil me-1"></i> Edit Offering
                    </a>
                    <form id="form-delete-{{ $offering->id }}"
                        action="{{ route('dashboard.master-data.offerings.destroy', $offering->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger d-flex align-items-center gap-2 justify-content-center w-100 btn-delete" data-id="{{ $offering->id }}"
                            data-name="{{ $offering->name ?? '-' }}">
                            <i class="ti ti-trash me-1"></i> Delete Offering
                        </button>
                    </form>
                    <hr class="my-4">
                    <h4 class="card-title fw-semibold mb-3">Notes</h4>
                    <p class="text-muted small">
                        This page displays detailed information about the selected offering. To make changes, click the "Edit Offering" button.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-delete').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const offeringId = this.getAttribute('data-id');
                    const offeringName = this.getAttribute('data-name');
                    Swal.fire({
                        title: "Delete Offering",
                        text: "Are you sure you want to delete the following offering: \"" + offeringName +
                            "\"? This action cannot be undone.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Delete",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('form-delete-' + offeringId).submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
