<?php

namespace App\Http\Requests\MasterData\Offering;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

// Enums
use App\Enums\OfferingTypeEnum;

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
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'string', Rule::enum(OfferingTypeEnum::class)],
            'image_file' => ['sometimes', 'file', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ];
    }
}
