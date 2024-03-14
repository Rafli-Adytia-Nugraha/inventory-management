<?php

namespace App\Exports;

use App\Models\InventoryItem;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class InventoryItemExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return InventoryItem::all();
    }

    public function headings(): array
    {
        return [
            'ID (UUID)',
            'Item Name',
            'Description',
            'Quantity on Hand',
            'Unit Price'
        ];
    }
}
