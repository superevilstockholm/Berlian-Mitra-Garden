@extends('layouts.dashboard')
@section('title', 'Activity Log Management')
@section('content')
    @php
        use App\Enums\ActivityMethodEnum;
        use Illuminate\Contracts\Pagination\LengthAwarePaginator;
    @endphp
    <div class="row mb-4">
        <div class="col">
            <div class="card my-0">
                <div
                    class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-2 gap-lg-5">
                    <div class="d-flex flex-column">
                        <h3 class="p-0 m-0 mb-1 fw-semibold">Activity Log Records</h3>
                        <p class="p-0 m-0 fw-medium text-muted">Manage activity log records.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card my-0">
                <div class="card-body">
                    <form method="GET" action="{{ route('dashboard.setting.activity-logs.index') }}" id="filterForm">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-3 gap-2 gap-md-0">
                            <div class="d-flex align-items-center">
                                @php
                                    $limits = [5, 10, 25, 50, 100];
                                    $currentLimit = request('limit', 10);
                                @endphp
                                <label for="limitSelect" class="form-label mb-0 me-2">Show</label>
                                <select class="form-select form-select-sm" id="limitSelect" name="limit"
                                    onchange="document.getElementById('filterForm').submit()">
                                    @foreach ($limits as $limit)
                                        <option value="{{ $limit }}"
                                            {{ (string) $currentLimit === (string) $limit ? 'selected' : '' }}>
                                            {{ $limit }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="ms-2">entries</span>
                            </div>
                            <div class="text-muted small">
                                @if ($activity_logs instanceof LengthAwarePaginator)
                                    Showing {{ $activity_logs->firstItem() }} to {{ $activity_logs->lastItem() }} of
                                    {{ $activity_logs->total() }} entries
                                @else
                                    Showing {{ $activity_logs->count() }} entries
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3 g-2">
                            {{-- Name --}}
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="user_name" class="form-control form-control-sm"
                                        id="filterUserName" placeholder="Name" value="{{ request('user_name') }}">
                                    <label for="filterUserName">Name</label>
                                </div>
                            </div>
                            {{-- Method --}}
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select name="method" id="filterMethod" class="form-select @error('method') is-invalid @enderror">
                                        <option value="" {{ old('method', request('method')) === null || old('method', request('method')) === '' ? 'selected' : '' }}>
                                            All Method
                                        </option>
                                        @foreach (ActivityMethodEnum::cases() as $method)
                                            <option value="{{ $method->value }}"
                                                {{ old('method', request('method')) == $method->value ? 'selected' : '' }}>
                                                {{ $method->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="filterMethod">Method</label>
                                    @error('method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Route Path --}}
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="route_path" class="form-control form-control-sm"
                                        id="filterRoutePath" placeholder="Route Path" value="{{ request('route_path') }}">
                                    <label for="filterRoutePath">Route Path</label>
                                </div>
                            </div>
                            {{-- Route Name --}}
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="route_name" class="form-control form-control-sm"
                                        id="filterRouteName" placeholder="Route Name" value="{{ request('route_name') }}">
                                    <label for="filterRouteName">Route Name</label>
                                </div>
                            </div>
                            {{-- IP Address --}}
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="ip_address" class="form-control form-control-sm"
                                        id="filterIPAddress" placeholder="IP Address" value="{{ request('ip_address') }}">
                                    <label for="filterIPAddress">IP Address</label>
                                </div>
                            </div>
                            {{-- User Agent --}}
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="user_agent" class="form-control form-control-sm"
                                        id="filterUserAgent" placeholder="User Agent" value="{{ request('user_agent') }}">
                                    <label for="filterUserAgent">User Agent</label>
                                </div>
                            </div>
                            {{-- Status Code --}}
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="number" name="status_code" class="form-control form-control-sm"
                                        id="filterStatusCode" placeholder="Status Code" value="{{ request('status_code') }}" min="1">
                                    <label for="filterStatusCode">Status Code</label>
                                </div>
                            </div>
                            {{-- Start Date --}}
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="date" name="start_date" class="form-control form-control-sm"
                                        id="filterStartDate" value="{{ request('start_date') }}">
                                    <label for="filterStartDate">Start Date</label>
                                </div>
                            </div>
                            {{-- End Date --}}
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="date" name="end_date" class="form-control form-control-sm"
                                        id="filterEndDate" value="{{ request('end_date') }}">
                                    <label for="filterEndDate">End Date</label>
                                </div>
                            </div>
                            {{-- Search Buttons --}}
                            <div class="col-12 col-md-6">
                                <button type="submit"
                                    class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="ti ti-search"></i> Search
                                </button>
                            </div>
                            {{-- Reset Buttons --}}
                            <div class="col-12 col-md-6">
                                <a href="{{ route('dashboard.setting.activity-logs.index') }}"
                                    class="btn btn-secondary w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="ti ti-rotate-clockwise-2"></i> Reset Filters
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive @if (!($activity_logs instanceof LengthAwarePaginator && $activity_logs->hasPages())) mb-0 @else mb-3 @endif">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Method</th>
                                    <th>Route Path</th>
                                    <th>IP Address</th>
                                    <th>Status Code</th>
                                    <th>Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($activity_logs as $index => $activity_log)
                                    <tr>
                                        <td class="text-center">
                                            @if ($activity_logs instanceof LengthAwarePaginator)
                                                {{ $activity_logs->firstItem() + $loop->index }}
                                            @else
                                                {{ $loop->iteration }}
                                            @endif
                                        </td>
                                        <td>{{ $activity_log->user_name ?? '-' }}</td>
                                        <td>
                                            @php
                                                $methodClass = match ($activity_log->method) {
                                                    ActivityMethodEnum::POST => 'border-primary text-primary',
                                                    ActivityMethodEnum::PUT, ActivityMethodEnum::PATCH => 'border-warning text-warning',
                                                    ActivityMethodEnum::DELETE => 'border-danger text-danger',
                                                    default => 'border-secondary text-secondary',
                                                };
                                            @endphp
                                            <span class="px-3 badge border rounded-pill {{ $methodClass }}">
                                                {{ $activity_log->method ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ $activity_log->route_path ?? '-' }}</td>
                                        <td>{{ $activity_log->ip_address ?? '-' }}</td>
                                        <td>{{ $activity_log->status_code ?? '-' }}</td>
                                        <td>{{ $activity_log->created_at?->format('d M Y H:i') }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button type="button" class="btn border-0 p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item d-flex align-items-center gap-2"
                                                        href="{{ route('dashboard.setting.activity-logs.show', $activity_log->id) }}">
                                                        <i class="ti ti-eye me-1"></i> View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div class="alert alert-warning my-2" role="alert">
                                                No activity log records found for the selected filters.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($activity_logs instanceof LengthAwarePaginator && $activity_logs->hasPages())
                        <div class="overflow-x-auto mt-0 py-1">
                            <div class="d-flex justify-content-center d-md-block w-100 px-3">
                                {{ $activity_logs->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
