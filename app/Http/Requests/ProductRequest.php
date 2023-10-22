<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'short_desc' => 'required|max:255',
            'long_desc' => 'required',
            'main_image' => 'required|max:100',
            'price' => 'required|numeric',
            'active' => 'boolean',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
