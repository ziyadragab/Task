<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'invoice_products' => 'required|array|min:1',
            'invoice_products.*.quantity' => 'integer|min:1',
            'invoice_products.*.price' => 'numeric|min:0',
        ];
    }
}
