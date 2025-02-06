<?php

namespace App\Http\Requests\admin;

use App\Rules\ProductExists;
use Illuminate\Foundation\Http\FormRequest;

class ProductImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', new ProductExists()],
            'name' =>  ['required', 'string'],
            'url' => ['required', 'string', 'unique:product_images'],
        ];
    }
}
