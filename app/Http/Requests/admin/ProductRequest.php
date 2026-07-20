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
            'category_ids' => ['sometimes' ,'array'],
            'category_ids.*' => ['integer', new CategoryExists()],  // Validate each item in the array
            'category_id' => ['sometimes', 'integer', new CategoryExists()],
            'name' => 'sometimes|string',
            'id' => ['integer', new ProductExists()],
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'per_page' => 'nullable|integer|min:1',
            'min_price'     => 'sometimes|numeric|min:0',
            'max_price'     => 'sometimes|numeric|min:0',      
            'input_search'  => 'sometimes|string'
        ];
    }
}
