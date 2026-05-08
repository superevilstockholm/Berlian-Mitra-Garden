<?php

namespace App\Http\Requests\Setting\ActivityLog;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

// Enums
use App\Enums\ActivityMethodEnum;

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
            'user_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'method' => ['sometimes', 'nullable', 'string', Rule::enum(ActivityMethodEnum::class)],
            'route_path' => ['sometimes', 'nullable', 'string'],
            'route_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'ip_address' => ['sometimes', 'nullable', 'string', 'max:255'],
            'user_agent' => ['sometimes', 'nullable', 'string'],
            'status_code' => ['sometimes', 'nullable', 'integer'],
            'start_date' => ['sometimes', 'nullable', 'date'],
            'end_date' => ['sometimes', 'nullable', 'date', 'after_or_equal:start_date'],
        ];
    }
}
