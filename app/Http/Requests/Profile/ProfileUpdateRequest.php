<?php

namespace App\Http\Requests\Profile;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
        return User::rules([
            'name' => 'nullable|string|min:3|max:150',
            'national_code' => 'nullable|numeric|ir_national_code|unique:users,national_code,'.$this->id,
            'email' => 'required|email|max:255|unique:users,email,'.$this->id,
            'mobile' => 'nullable|ir_mobile:zero|max:11|unique:users,mobile,'.$this->id,
            'password' => 'nullable|string|min:6|max:32',
        ]);
    }
}
