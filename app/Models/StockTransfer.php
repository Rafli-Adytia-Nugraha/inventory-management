<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'inventory_item_id',
        'from_warehouse_id',
        'to_warehouse_id',
        'quantity_adjusted',
        'reason',
        'transaction_date',
    ];

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id', 'id');
    }

    public function fromWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'from_warehouse_id', 'id');
    }

    public function toWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'to_warehouse_id', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('quantity_adjusted', 'like', '%' . $search . '%')
                ->orWhere('reason', 'like', '%' . $search . '%')
                ->orWhereHas('inventoryItem', function ($subquery) use ($search) {
                    $subquery->where('item_name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('fromWarehouse', function ($subquery) use ($search) {
                    $subquery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('toWarehouse', function ($subquery) use ($search) {
                    $subquery->where('name', 'like', '%' . $search . '%');
                });
        });

    }
}
