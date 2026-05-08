@extends('layouts.dashboard')
@section('title', 'User Details')
@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card my-0">
                <div
                    class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-2 gap-lg-5">
                    <div class="d-flex flex-column">
                        <h3 class="p-0 m-0 mb-1 fw-semibold">User Details</h3>
                        <p class="p-0 m-0 fw-medium text-muted">View detailed information about this user.</p>
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
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-3">User Details</h4>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Name</div>
                        <div class="col-md-8 fw-medium">{{ $user->name ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Email</div>
                        <div class="col-md-8 fw-medium">{{ $user->email ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Email Verified At</div>
                        <div class="col-md-8 fw-medium">{{ $user->email_verified_at ?? 'Belum Diverifikasi' }}</div>
                    </div>
                    <h4 class="card-title fw-semibold mt-4 mb-3">System Information</h4>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">User ID</div>
                        <div class="col-md-8 fw-medium">{{ $user->id ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Created At</div>
                        <div class="col-md-8 fw-medium">{{ $user->created_at?->format('d M Y H:i:s') ?? '-' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-muted">Updated At</div>
                        <div class="col-md-8 fw-medium">{{ $user->updated_at?->format('d M Y H:i:s') ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card my-0">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-3">Quick Actions</h4>
                    <a href="{{ route('dashboard.master-data.users.edit', $user->id) }}"
                        class="btn btn-warning d-flex align-items-center gap-2 justify-content-center w-100 mb-2">
                        <i class="ti ti-pencil me-1"></i> Edit User
                    </a>
                    <form id="form-delete-{{ $user->id }}"
                        action="{{ route('dashboard.master-data.users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger d-flex align-items-center gap-2 justify-content-center w-100 btn-delete" data-id="{{ $user->id }}"
                            data-name="{{ $user->formatted_name ?? '-' }}">
                            <i class="ti ti-trash me-1"></i> Delete User
                        </button>
                    </form>
                    <hr class="my-4">
                    <h4 class="card-title fw-semibold mb-3">Notes</h4>
                    <p class="text-muted small">
                        This page displays detailed information about the selected user. To make changes, click the "Edit User" button.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-delete').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    const userName = this.getAttribute('data-name');
                    Swal.fire({
                        title: "Delete User",
                        text: "Are you sure you want to delete the following user: \"" + userName +
                            "\"? This action cannot be undone.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Delete",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('form-delete-' + userId).submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
