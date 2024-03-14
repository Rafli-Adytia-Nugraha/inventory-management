<?php

namespace App\Models;

use App\Models\StockMovement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryItem extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'item_name',
        'description',
        'quantity_on_hand',
        'unit_price',
    ];

    public function adjustments()
    {
        return $this->hasMany(StockMovement::class);
    }
}
