<?php

namespace App\Http\Requests\Verify;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class VerifyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('verify-update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_level_id' => 'nullable|exists:user_levels,id',
            'authorize_file_status' => 'required|in:pending,accepted,rejected',
            'authorize_file_text' => 'nullable|min:3|max:250',
            'national_card_file_status' => 'required|in:pending,accepted,rejected',
            'national_card_file_text' => 'nullable|min:3|max:250',
        ];
    }
}
