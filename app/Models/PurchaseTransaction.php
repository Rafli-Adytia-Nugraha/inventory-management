<?php

namespace App\Models;

use App\Models\InventoryItem;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTransaction extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'transaction_date',
        'quantity_purchased',
        'unit_price',
        'total_price',
        'item_id',
        'order_id',
    ];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function order()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}