<?php

namespace App\Http\Requests\admin;

use App\Rules\CategoryExists;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => ['array'],
            'category_id.*' => ['integer', new CategoryExists()],  // Validate each item in the array
            'name' => 'string',
            'description' => 'string',
            'price' => 'numeric|min:0',
            'stock' => 'integer|min:0',
        ];
    }
}
