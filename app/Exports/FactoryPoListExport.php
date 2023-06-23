<?php

namespace App\Exports;

use App\Income;
use App\FactoryPo;
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

class FactoryPoListExport implements FromArray,ShouldAutoSize,WithHeadings
{
    use Exportable;

    protected $from_date;
    protected $to_date;
    protected $type;


    public function __construct($from,$to,$type){
        $this->from_date = $from;
        $this->to_date = $to;
        $this->type=$type;
    }


   public function array() :array
    {



            if ($this->type == 1){
                $po_lists = array();
                $pos = FactoryPo::whereBetween('po_date',[$this->from_date, $this->to_date])->get();
                foreach($pos as $po){


                    $po_number=$po->po_number;
                    $date = $po->po_date;
                    $receive_date=$po->receive_date;
                    $type = $po->po_type;
                    $total_rolls=$po->total_rolls;
                    $total_yards=$po->total_yards;
                    $total_quantity=$po->total_quantity;
                    $total_price=$po->total_price;
                    $approved=$po->approved_by;
                    $requested=$po->requested_by;


                    $combined = array('po_number' => $po_number, 'date' => $date,'receive_date' => $receive_date, 'type' => $type, 'total_rolls' => $total_rolls, 'total_yards' => $total_yards, 'total_quantity' => $total_quantity, 'total_price' => $total_price, 'approved' => $approved, 'requested' => $requested);

                    array_push($po_lists, $combined);

            }
            return $po_lists;
        }


            elseif($this->type == 2){
                $item_lists = array();
                $pos = FactoryPo::whereBetween('po_date',[$this->from_date, $this->to_date])->with('factory_items')->get();

                foreach($pos as $po){

                    $po_number=$po->po_number;
                    $date = $po->po_date;
                    $receive_date=$po->receive_date;
                    $type = $po->po_type;
                    $approved=$po->approved_by;
                    $requested=$po->requested_by;


                   foreach($po->factory_items as $poItems) {

                       $item_name= $poItems->item_name;
                       $purchase_price = $poItems->pivot->purchase_price;
                       $rolls = $poItems->pivot->rolls;
                       $yards_per_roll = $poItems->pivot->yards_per_roll;
                       $sub_yards = $poItems->pivot->sub_yards;
                       $order_qty = $poItems->pivot->order_qty;
                       $remark = $poItems->pivot->remark;

                       $combined = array('item_name'=>$item_name,'purchase_price'=>$purchase_price,'rolls'=>$rolls,'yards_per_roll'=>$yards_per_roll,'sub_yards'=>$sub_yards,'order_qty'=>$order_qty,'remark'=>$remark,'po_number' => $po_number, 'date' => $date,'receive_date' => $receive_date, 'type' => $type, 'approved' => $approved, 'requested' => $requested);

                       array_push($item_lists,$combined);
                    }

                }
                return $item_lists;
            }



    }


    public function headings():array{

        if($this->type == 1){
            return [
                'Po_number',
                'Po_date',
                'Receive_date',
                'Po_type',
                'Total_rolls',
                'Total_yards',
                'Total_Quantity',
                'Total_price',
                'Requested_by',
                'Approved_by'
            ];
        }elseif($this->type == 2){
            return [
                'Item',
                'Purchase_price',
                'Rolls',
                'Yards_per_roll',
                'Sub_yards',
                'Order_qty',
                'Remark',
                'Po_number',
                'Po_date',
                'Receive_date',
                'Po_type',
                'Requested_by',
                'Approved_by'
            ];
        }


    }


}
