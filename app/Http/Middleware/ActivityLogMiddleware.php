<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Models
use App\Models\Setting\ActivityLog;

class ActivityLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!in_array($request->method(), [
            'POST',
            'PUT',
            'PATCH',
            'DELETE',
        ])) {
            return $response;
        }

        if (
            $request->is([
                '_debugbar/*',
                'livewire/*',
                'storage/*',
                'build/*',
            ])
        ) {
            return $response;
        }

        $payload = $request->except([
            '_token',
            '_method',
            'password',
            'password_confirmation',
        ]);

        foreach ($request->allFiles() as $key => $file) {
            $payload[$key] = $file->getClientOriginalName();
        }

        ActivityLog::create([
            'user_id' => $request->user()?->id ?? null,
            'user_name' => $request->user()?->name ?? null,

            'method' => $request->method(),

            'route_path' => $request->path(),
            'route_name' => $request->route()?->getName(),

            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),

            'payload' => $payload,

            'status_code' => $response->getStatusCode(),
        ]);

        return $response;
    }
}
