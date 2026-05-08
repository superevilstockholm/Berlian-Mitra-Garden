@extends('layouts.dashboard')
@section('title', 'Activity Log Details')
@section('content')
    @php
        use App\Enums\ActivityMethodEnum;
    @endphp
    <div class="row mb-4">
        <div class="col">
            <div class="card my-0">
                <div
                    class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-2 gap-lg-5">
                    <div class="d-flex flex-column">
                        <h3 class="p-0 m-0 mb-1 fw-semibold">Activity Log Details</h3>
                        <p class="p-0 m-0 fw-medium text-muted">View detailed information about this activity log.</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('dashboard.setting.activity-logs.index') }}"
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
                    <h4 class="card-title fw-semibold mb-3">Activity Log Details</h4>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Name</div>
                        <div class="col-md-8 fw-medium">{{ $activity_log->user_name ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Method</div>
                        @php
                            $methodClass = match ($activity_log->method) {
                                ActivityMethodEnum::POST => 'border-primary text-primary',
                                ActivityMethodEnum::PUT, ActivityMethodEnum::PATCH => 'border-warning text-warning',
                                ActivityMethodEnum::DELETE => 'border-danger text-danger',
                                default => 'border-secondary text-secondary',
                            };
                        @endphp
                        <div class="col-md-8 fw-medium">
                            <span class="px-3 badge border rounded-pill {{ $methodClass }}">
                                {{ $activity_log->method ?? '-' }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Route Path</div>
                        <div class="col-md-8 fw-medium">{{ $activity_log->route_path ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Route Name</div>
                        <div class="col-md-8 fw-medium">{{ $activity_log->route_name ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">IP Address</div>
                        <div class="col-md-8 fw-medium">{{ $activity_log->ip_address ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">User Agent</div>
                        <div class="col-md-8 fw-medium">{{ $activity_log->user_agent ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Status Code</div>
                        <div class="col-md-8 fw-medium">{{ $activity_log->status_code ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Payload</div>
                        @php
                            $payload = $activity_log->payload;
                                if (is_string($payload)) {
                                    $payload = json_decode($payload, true);
                                }
                            @endphp
                            <div class="col-md-8 fw-medium">
                                <pre class="mb-0 p-3 rounded border small">{{ is_array($payload) ? json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : ($payload ?? '-') }}</pre>
                            </div>
                    </div>
                    <h4 class="card-title fw-semibold mt-4 mb-3">System Information</h4>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Activity Log ID</div>
                        <div class="col-md-8 fw-medium">{{ $activity_log->id ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Created At</div>
                        <div class="col-md-8 fw-medium">{{ $activity_log->created_at?->format('d M Y H:i:s') ?? '-' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-muted">Updated At</div>
                        <div class="col-md-8 fw-medium">{{ $activity_log->updated_at?->format('d M Y H:i:s') ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card my-0">
                <div class="card-body">
                    <h4 class="card-title fw-semibold mb-3">Notes</h4>
                    <p class="text-muted small">
                        This page displays detailed information about the selected activity log. You cannot edit or delete this activity log.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
