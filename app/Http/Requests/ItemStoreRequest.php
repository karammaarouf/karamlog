<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() ? $this->user()->can('create-items') : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'code' => 'required|string|unique:items,code',
            'quantity' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'discount' => 'nullable|numeric|min:0',
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
            'name.required' => __('The item name is required.'),
            'price.required' => __('The item price is required.'),
            'code.required' => __('The item code is required.'),
            'code.unique' => __('The item code has already been taken.'),
            'quantity.required' => __('The item quantity is required.'),
            'is_active.boolean' => __('The item active status must be a boolean value.'),
        ];
    }
}
