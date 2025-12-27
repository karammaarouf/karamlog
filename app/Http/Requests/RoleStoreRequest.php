<?php

namespace App\Http\Requests;

use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create-roles', Role::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules=[
            'permissions' => ['array'],
        ];
        foreach(config('app.available_locales') as $locale){
            $rules['name_'.$locale] = ['required', 'string', 'max:255','unique:roles,name'];
            $rules['description_'.$locale] = ['nullable', 'string'];
        }
        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('The role name is required.'),
            'description.max' => __('The role description may not be greater than 255 characters.'),
            'name.unique' => __('The role name has already been taken.'),
        ];
    }
}
