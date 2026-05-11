@extends('layouts.dashboard')
@section('title', 'Partner Details')
@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card my-0">
                <div
                    class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-2 gap-lg-5">
                    <div class="d-flex flex-column">
                        <h3 class="p-0 m-0 mb-1 fw-semibold">Partner Details</h3>
                        <p class="p-0 m-0 fw-medium text-muted">View detailed information about this partner.</p>
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
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-3">Partner Details</h4>
                    <div class="row mb-3">
                        <div class="col-12 fw-medium">
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }} Image" class="w-100 rounded object-fit-cover border" style="max-width: 300px; height: 200px; object-position: center;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Name</div>
                        <div class="col-md-8 fw-medium">{{ $partner->name ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Website</div>
                        <div class="col-md-8 fw-medium">
                            @if ($partner->website_url)
                                <a class="text-decoration-none d-flex align-items-center gap-1" href="{{ $partner->website_url }}">
                                    <i class="ti ti-link"></i>
                                    {{ $partner->website_url }}
                                </a>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Description</div>
                        <div class="col-md-8 fw-medium">{{ $partner->description ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Visibility</div>
                        <div class="col-md-8 fw-medium">{{ $partner->is_featured ? 'Visible' : 'Hidden' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Order</div>
                        <div class="col-md-8 fw-medium">{{ $partner->order ?? '-' }}</div>
                    </div>
                    <h4 class="card-title fw-semibold mt-4 mb-3">System Information</h4>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Partner ID</div>
                        <div class="col-md-8 fw-medium">{{ $partner->id ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Created At</div>
                        <div class="col-md-8 fw-medium">{{ $partner->created_at?->format('d M Y H:i:s') ?? '-' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-muted">Updated At</div>
                        <div class="col-md-8 fw-medium">{{ $partner->updated_at?->format('d M Y H:i:s') ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card my-0">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-3">Quick Actions</h4>
                    <a href="{{ route('dashboard.master-data.partners.edit', $partner->id) }}"
                        class="btn btn-warning d-flex align-items-center gap-2 justify-content-center w-100 mb-2">
                        <i class="ti ti-pencil me-1"></i> Edit Partner
                    </a>
                    <form id="form-delete-{{ $partner->id }}"
                        action="{{ route('dashboard.master-data.partners.destroy', $partner->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger d-flex align-items-center gap-2 justify-content-center w-100 btn-delete" data-id="{{ $partner->id }}"
                            data-name="{{ $partner->name ?? '-' }}">
                            <i class="ti ti-trash me-1"></i> Delete Partner
                        </button>
                    </form>
                    <hr class="my-4">
                    <h4 class="card-title fw-semibold mb-3">Notes</h4>
                    <p class="text-muted small">
                        This page displays detailed information about the selected partner. To make changes, click the "Edit Partner" button.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-delete').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const partnerId = this.getAttribute('data-id');
                    const partnerName = this.getAttribute('data-name');
                    Swal.fire({
                        title: "Delete Partner",
                        text: "Are you sure you want to delete the following partner: \"" + partnerName +
                            "\"? This action cannot be undone.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Delete",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('form-delete-' + partnerId).submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
