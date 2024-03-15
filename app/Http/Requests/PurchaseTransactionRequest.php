<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'item_id' => 'required|exists:inventory_items,id',
            'order_id' => 'required|exists:purchase_orders,id',
            'transaction_date' => 'required|date',
            'quantity_purchased' => 'required|integer|min:1',
            'unit_price' => 'required|integer|min:0',
            'total_price' => 'required|integer|min:0',
        ];
    }
}
