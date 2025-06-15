<?php

namespace App\Http\Requests\admin;

use App\Rules\CategoryExists;
use App\Rules\ProductExists;
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
            'category_id' => ['sometimes' ,'array'],
            'category_id.*' => ['integer', new CategoryExists()],  // Validate each item in the array
            'name' => 'sometimes|string',
            'id' => ['sometimes', 'array'],
            'id.*' => ['integer', new ProductExists()],
            'description' => 'string',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'per_page' => 'nullable|integer|min:1'
        ];
    }
}
