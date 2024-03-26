<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReconcileStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'inventory_item_id' => 'required|exists:inventory_items,id',
            'adjusted_quantity' => 'required|integer',
            'reason' => 'required|string|max:255',
        ];
    }
}
