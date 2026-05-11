<?php

namespace App\Http\Requests\MasterData\Partner;

use Illuminate\Foundation\Http\FormRequest;

// Models
use App\Models\MasterData\Partner;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $allowedMaxOrder = Partner::count();
        return [
            'name' => ['required', 'string', 'max:255'],
            'website_url' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'logo_file' => ['sometimes', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'order' => ['required', 'integer', 'min:1', 'max:' . $allowedMaxOrder],
        ];
    }
}
