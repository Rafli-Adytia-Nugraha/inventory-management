<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_date' => 'required|date',
            'delivery_date' => 'required|date',
            'total_amount' => 'required|integer',
            'supplier_id' => 'required|exists:suppliers,id',
        ];

    }
}
