<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() ? $this->user()->can('update-items') : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules=[
            'price' => 'required|numeric|min:0',
            'code' => 'required|string|unique:items,code,' . $this->item->id,
            'quantity' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'discount' => 'nullable|numeric|min:0',
        ];
        foreach (config('app.available_locales',['en','ar']) as $locale) {
            $rules['name_'.$locale] = 'required|string|max:255';
            $rules['description_'.$locale] = 'nullable|string|max:255';
        }
        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     * 
     */
        
    

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
