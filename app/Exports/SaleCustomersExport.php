<?php

namespace App\Exports;

use App\SalesCustomer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SaleCustomersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SalesCustomer::all();
    }

    public function headings():array{

        return [
            'id',
            'name',
            'phone',
            'total_purchase_amount',
            'total_purchase_quantity',
            'total_purchase_times',
            'last_purchase_date',
            'deleted_at',
            'updated_at',
            'created_at',
        ];

    }
}
