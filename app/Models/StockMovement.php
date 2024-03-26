<?php

namespace App\Models;

use App\Models\InventoryItem;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'inventory_item_id', 'transaction_date', 'quantity_adjusted', 'reason',
    ];

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('quantity_adjusted', 'like', '%' . $search . '%')
                ->orWhere('reason', 'like', '%' . $search . '%')
                ->orWhereHas('inventoryItem', function ($query) use ($search) {
                    $query->where('item_name', 'like', '%' . $search . '%');
                });
        });
    }

}
