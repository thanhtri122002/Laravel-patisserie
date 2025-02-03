<?php

namespace App\Http\Requests\Admin;

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
            'product_id' => ['required', 'integer', new CategoryExists()],
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|nemeric|min:0',
            'stock' => 'required|integer|min:0',
        ];
    }
}
