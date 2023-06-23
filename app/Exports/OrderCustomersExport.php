<?php

namespace App\Exports;

use App\OrderCustomer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderCustomersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OrderCustomer::all();
    }

    public function headings():array{
        return [
            'id',
            'name',
            'phone',
            'address',
            'total_purchase_amount',
            'total_purchase_quantity',
            'total_purchase_times',
            'last_purchase_date',
            'created_at',
            'updated_at',
        ];

    }
}
