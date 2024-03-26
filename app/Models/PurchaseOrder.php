<?php

namespace App\Models;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'order_date',
        'delivery_date',
        'total_amount',
        'supplier_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('order_date', 'like', '%' . $search . '%')
                ->orWhere('delivery_date', 'like', '%' . $search . '%')
                ->orWhere('total_amount', 'like', '%' . $search . '%')
                ->orWhereHas('supplier', function ($subquery) use ($search) {
                    $subquery->where('supplier_name', 'like', '%' . $search . '%');
                });
        });
    }
}
