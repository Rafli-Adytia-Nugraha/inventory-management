<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'item_name',
        'description',
        'quantity_on_hand',
        'unit_price',
    ];
}
