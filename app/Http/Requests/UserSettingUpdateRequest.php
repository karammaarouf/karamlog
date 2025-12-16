<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSettingUpdateRequest extends FormRequest
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
            'layout' => 'sometimes|string|in:rtl,ltr,Box',
            'sidebar_type' => 'sometimes|string|in:Vertical,Horizontal',
            'icon' => 'sometimes|string|in:Stroke,Colorful',
            'mode' => 'sometimes|string|in:Dark,Light,Mix',
            'color' => 'sometimes|string|in:#308e87,#57375D,#0766AD,#025464,#884A39,#0C356A',
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
            'layout.in' => __('The layout must be rtl, ltr, or Box.'),
            'sidebar_type.in' => __('The sidebar type must be Vertical or Horizontal.'),
            'icon.in' => __('The icon must be Stroke or Colorful.'),
            'mode.in' => __('The mode must be Dark, Light, or Mix.'),
            'color.in' => __('The color must be #308e87, #57375D, #0766AD, #025464, #884A39, or #0C356A.'),
        ];
    }
}
