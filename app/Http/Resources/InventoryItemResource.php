<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'item_name' => $this->item_name,
            'description' => $this->description,
            'quantity_on_hand' => $this->quantity_on_hand,
            'unit_price' => $this->unit_price,
            'warehouse' => $this->warehouse,
        ];
    }
}
