<?php

namespace App\Http\Requests\MasterData\Offering;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

// Enums
use App\Enums\OfferingTypeEnum;

class IndexRequest extends FormRequest
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
            'limit' => ['sometimes', 'nullable', 'integer', 'min:1', 'max:100'],
            'name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'type' => ['sometimes', 'nullable', 'string', Rule::enum(OfferingTypeEnum::class)],
            'start_date' => ['sometimes', 'nullable', 'date'],
            'end_date' => ['sometimes', 'nullable', 'date', 'after_or_equal:start_date'],
        ];
    }
}
