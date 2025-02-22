<?php

namespace App\Http\Requests\Activate;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserActivateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'father_name' => 'required|string|max:50',
            'authorize_file' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'national_card_file' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'full_name' => 'required|string|min:3|max:50',
            'birthday' => 'required|date_format:Y/m/d',
            'gender' => 'required|string|in:male,female',
            'address' => 'nullable|string|min:3|max:150',
            'national_code' => 'required|ir_national_code|digits:10|numeric|unique:users,national_code,'.auth()->user()->id,
        ];
    }
}
