<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

// Attributes
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;

// Enums
use App\Enums\OfferingTypeEnum;

#[Fillable(['name', 'description', 'image_path', 'type'])]
#[Appends(['image_url'])]
class Offering extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string | OfferingTypeEnum>
     */
    protected function casts(): array
    {
        return [
            'type' => OfferingTypeEnum::class,
        ];
    }

    public function getImageUrlAttribute(): string
    {
        /** @disregard */
        return $this->image_path
            ? Storage::disk('public')->url($this->image_path)
            : asset('static/img/no-image-placeholder.svg');
    }
}
