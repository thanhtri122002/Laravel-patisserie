<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class ProductDetailRequest extends FormRequest
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
            'product_id' => 'required|exists:products, id',
            'cart_id' => 'nullable|exists:carts, id',
            'invoice_id' => 'nullable|exists:invoices, id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|min:0|integer',
            'discount' => 'nullable|numeric|min:0',
            'cost' => 'nullable|numeric|min:0'
        ];
    }
}
