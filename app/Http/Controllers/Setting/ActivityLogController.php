<?php

namespace App\Http\Controllers\Setting;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

// Models
use App\Models\Setting\ActivityLog;

// Requests
use App\Http\Requests\Setting\ActivityLog\IndexRequest;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request): View
    {
        $validated = $request->validated();
        $limit = $validated['limit'] ?? 10;

        $query = ActivityLog::query()->orderBy('created_at', 'desc');

        if (isset($validated['user_name'])) {
            $query->where('user_name', 'ILIKE', '%' . $validated['user_name'] . '%');
        }
        if (isset($validated['method'])) {
            $query->where('method', $validated['method']);
        }
        if (isset($validated['route_path'])) {
            $query->where('route_path', 'ILIKE', '%' . $validated['route_path'] . '%');
        }
        if (isset($validated['route_name'])) {
            $query->where('route_name', 'ILIKE', '%' . $validated['route_name'] . '%');
        }
        if (isset($validated['ip_address'])) {
            $query->where('ip_address', 'ILIKE', '%' . $validated['ip_address'] . '%');
        }
        if (isset($validated['user_agent'])) {
            $query->where('user_agent', 'ILIKE', '%' . $validated['user_agent'] . '%');
        }
        if (isset($validated['status_code'])) {
            $query->where('status_code',$validated['status_code']);
        }
        if (isset($validated['start_date'])) {
            $query->where('created_at', '>=', Carbon::parse($validated['start_date'])->startOfDay());
        }
        if (isset($validated['end_date'])) {
            $query->where('created_at', '<=', Carbon::parse($validated['end_date'])->endOfDay());
        }

        $activity_logs = $query->paginate($limit)->appends($request->except('page'));

        return view('pages.dashboard.setting.activity-log.index', [
            'activity_logs' => $activity_logs,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivityLog $activityLog)
    {
        //
    }
}
