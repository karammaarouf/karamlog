<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class ProfilePasswordUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->id == $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required','string','min:8',function($attribute, $value, $fail) {
                if (!Hash::check($value, $this->user()->password)) {
                    $fail(__('The current password is incorrect'));
                }
            }],
            'new_password' => ['required','string','min:8','confirmed'],
        ];
    }
    
    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'current_password.required' => __('The current password is required.'),
            'new_password.required' => __('The new password is required.'),
            'new_password.confirmed' => __('The new password confirmation does not match.'),
        ];
    }
}
