<?php

namespace App\Http\Requests\MasterData\Mission;

use Illuminate\Foundation\Http\FormRequest;

// Models
use App\Models\MasterData\Mission;

class StoreRequest extends FormRequest
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
        $allowedMaxOrder = Mission::count() + 1;
        return [
            'content' => ['required', 'string'],
            'order' => ['required', 'string', 'min:1', 'max:' . $allowedMaxOrder],
        ];
    }
}
