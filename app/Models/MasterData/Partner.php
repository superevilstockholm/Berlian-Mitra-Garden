<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

// Attributes
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name'. 'logo_path', 'website', 'description', 'is_featured', 'order'])]
#[Appends(['logo_url'])]
class Partner extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'order' => 'integer',
        ];
    }

    public function getLogoUrlAttribute(): string
    {
        /** @disregard */
        return $this->logo_path
            ? Storage::disk('public')->url($this->logo_path)
            : asset('static/img/no-image-placeholder.svg');
    }
}
