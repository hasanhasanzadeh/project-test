<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'mobile' => 'required|unique:users,mobile|ir_mobile:zero',
            'password' => 'required|string|min:6|max:32',
            'g-recaptcha-response' => 'required|captcha',
            'referral_code' => 'nullable|exists:users,referral_code',
        ];
    }
}
