<?php

namespace App\Exports;


use App\Itemadjust;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ItemAdjustListExport implements FromArray, ShouldAutoSize, WithHeadings
{
    use Exportable;

    protected $from_date;
    protected $to_date;


    public function __construct($from, $to)
    {
        $this->from_date = $from;
        $this->to_date = $to;
    }


    public function array(): array
    {
        $item = array();
        $item_adjusts =  Itemadjust::whereBetween('adjust_date', [$this->from_date, $this->to_date])->get();

        foreach ($item_adjusts as  $item_adjust) {


            $combined = array('date' => $item_adjust->adjust_date, 'item_name' =>  $item_adjust->counting_unit->unit_name, 'old_qyt' => $item_adjust->oldstock_qty, 'adjust_qty' => $item_adjust->adjust_qty, 'new_qty' => $item_adjust->newstock_qty, 'changed_by' => $item_adjust->user->name, 'remark' => $item_adjust->adjust_remark);
            array_push($item, $combined);
        }

        return $item;
    }


    public function headings(): array
    {

        return [
            'Date',
            'Item Name',
            'Old Qyt',
            'Adjust Qty',
            'New Qty',
            'Changed by',
            'Remark'
        ];
    }
}
