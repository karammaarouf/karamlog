<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users,email,'.auth()->user()->id],
            'phone' => ['nullable','integer','max:20'],
            'address' => ['nullable','string','max:255'],
            'city' => ['nullable','string','max:255'],
            'state' => ['nullable','string','max:255'],
            'country' => ['nullable','string','max:255'],
            'birth_date' => ['nullable','date'],
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
            'name.required' => __('The name is required.'),
            'email.required' => __('The email is required.'),
            'email.email' => __('The email must be a valid email address.'),
            'email.unique' => __('The email has already been taken.'),
            'phone.integer' => __('The phone must be an integer.'),
            'phone.max' => __('The phone may not be greater than 20 digits.'),
            'address.max' => __('The address may not be greater than 255 characters.'),
            'city.max' => __('The city may not be greater than 255 characters.'),
            'state.max' => __('The state may not be greater than 255 characters.'),
            'country.max' => __('The country may not be greater than 255 characters.'),
            'birth_date.date' => __('The birth date must be a valid date.'),
        ];
    }
}
