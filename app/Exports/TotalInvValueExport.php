<?php

namespace App\Exports;


use App\CountingUnit;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TotalInvValueExport implements FromArray,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array() :array
    {
        $data=[];

        $units= CountingUnit::where('current_quantity','!=', 0)->orderBy('unit_name','ASC')->get();

        foreach ($units as $index=>$unit)
        {
            $combined = array('index'=>++$index,'unit_code'=>$unit->unit_code??'','unit_name'=>$unit->unit_name ?? '','currenty_qty'=>$unit->current_quantity ?? 0,'purchase_price'=>$unit->purchase_price,'sub_total'=>$unit->purchase_price * $unit->current_quantity);

            array_push($data, $combined);
        }

         return $data;

    }

    public function headings():array{

        return [
            'No',
            'Unit_code',
            'Unit_name',
            'Current Qty',
            'Purchase Price',
            'Sub Total'
        ];

    }
}
