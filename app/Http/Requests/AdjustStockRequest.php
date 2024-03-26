<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdjustStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => 'required|numeric|not_in:0',
            'reason' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'Quantity field is required.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.min' => 'Quantity must be at least 1 or -1.',
            'reason.required' => 'Reason field is required.',
            'reason.string' => 'Reason must be a string.',
        ];
    }
}
