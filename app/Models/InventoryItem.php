<?php

namespace App\Models;

use App\Models\StockMovement;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

class InventoryItem extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'item_name',
        'description',
        'quantity_on_hand',
        'unit_price',
        'warehouse_id',
    ];

    public function stockMovement()
    {
        return $this->hasMany(StockMovement::class, 'inventory_item_id', 'id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('item_name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('quantity_on_hand', 'like', '%' . $search . '%')
                ->orWhere('unit_price', 'like', '%' . $search . '%')
                ->orWhereHas('warehouse', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        });

    }

    public function getUnitPriceFormattedAttribute()
    {
        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->unit_price, 'IDR');
    }
}
