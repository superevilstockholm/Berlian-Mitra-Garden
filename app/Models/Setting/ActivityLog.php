<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

// Attributes
use Illuminate\Database\Eloquent\Attributes\Fillable;

// Models
use App\Models\MasterData\User;

// Enums
use App\Enums\ActivityMethodEnum;

#[Fillable(['user_id', 'user_name', 'method', 'route_path', 'route_name', 'ip_address', 'user_agent', 'payload', 'status_code'])]
class ActivityLog extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'status_code' => 'integer',
            'method' => ActivityMethodEnum::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
