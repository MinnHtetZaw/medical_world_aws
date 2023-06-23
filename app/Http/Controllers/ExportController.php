<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\ReceivePayHistoryExport;

class ExportController extends Controller
{
    //
    private $excel;


    public function __construct(Excel $excel){
        $this->excel = $excel;
    }

    protected function receivableHistoryExport(Request $request,$from,$to,$id){
        return $this->excel->download(new ReceivePayHistoryExport($from,$to,$id,1),'receivable_history.xlsx');
    }

    protected function payableHistoryExport(Request $request,$from,$to,$id){
        return $this->excel->download(new ReceivePayHistoryExport($from,$to,$id,2),'payable_history.xlsx');
    }

}
