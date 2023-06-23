<?php

namespace App\Http\Controllers\Api;

use App\Getlocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiBaseController;
use App\CountingUnit;
use App\Design;
use App\Fabric;
use App\Colour;
use App\Size;
use App\Gender;
use App\Item;


class CountingUnitApiController extends ApiBaseController
{
   public function index(){
       $countingUnits = CountingUnit::where('current_quantity', '>', 0)->get();

       //========================
       $counting_unit_list = array();
            foreach($countingUnits as $counting_unit){
            //Specs
                $design = Design::find($counting_unit->design_id);
                $fabric = Fabric::find($counting_unit->fabric_id);
                $colour = Colour::find($counting_unit->colour_id);
                $size = Size::find($counting_unit->size_id);
                $gender = Gender::find($counting_unit->gender_id);
            //

            $id = $counting_unit->id;
            $unit_code = $counting_unit->unit_code;
            $unit_name = $counting_unit->unit_name;
            $design_name = $design->design_name;
            $fabric_name = $fabric->fabric_name ?? 'Fabric is Null';
            $colour_name = $colour->colour_name;
            $size_name = $size->size_name;
            $gender_name = $gender->gender_name;
            $order_price = $counting_unit->order_price;
            $purchase_price = $counting_unit->purchase_price;
            $item_id = $counting_unit->item_id;
            $combined = array('id' => $id, 'unit_code' => $unit_code, 'unit_name' => $unit_name, 'design_name' => $design_name, 'fabric_name' =>$fabric_name, 'colour_name' => $colour_name, 'size_name' => $size_name, 'gender_name' => $gender_name, 'order_price' => $order_price, 'purchase_price' => $purchase_price, 'item_id' => $item_id);

            array_push($counting_unit_list, $combined);

            }
       //========================
       return response()->json([
           "data" => $counting_unit_list,
           ]);
   }

   public function getUnitById(Request $request,$id){
    //    $its = Item::where('sub_category_id',$id)->first();
       $its = Item::where('id',$id)->first();
       $countingUnits = CountingUnit::where('item_id',$its->id)->where('current_quantity', '>', 0)->get();
       $countingUnitsAll = CountingUnit::where('item_id',$its->id)->get();
       $item = Item::find($its->id);

       $flag = Item::where('id', $its->id)->first();
       $valueofinstock = $flag->instock;
       $valueofpreorder = $flag->preorder;

       //========================
       $counting_unit_list = array();
            foreach($countingUnits as $counting_unit){
            //Specs
                $design = Design::find($counting_unit->design_id);
                $fabric = Fabric::find($counting_unit->fabric_id);
                $colour = Colour::find($counting_unit->colour_id);
                $size = Size::find($counting_unit->size_id);
                $gender = Gender::find($counting_unit->gender_id);
            //

            $id = $counting_unit->id;
            $unit_code = $counting_unit->unit_code;
            $unit_name = $counting_unit->unit_name;
            $design_name = $design->design_name;
            $fabric_name = $fabric->fabric_name ?? 'Fabric is Null';
            $colour_name = $colour->colour_name;

            $size_name = $size->size_name;
            $gender_name = $gender->gender_name;
            $current_quantity = $counting_unit->current_quantity;
            $order_price = $counting_unit->order_price;
            $purchase_price = $counting_unit->purchase_price;
            $item_id = $counting_unit->item_id;
            $combined = array('id' => $id, 'unit_code' => $unit_code, 'unit_name' => $unit_name, 'design_name' => $design_name, 'fabric_name' =>$fabric_name, 'colour_name' => $colour_name, 'size_name' => $size_name, 'gender_name' => $gender_name, 'current_quantity' => $current_quantity, 'order_price' => $order_price, 'purchase_price' => $purchase_price, 'item_id' => $item_id);

            array_push($counting_unit_list, $combined);

            }
       //========================

       //========================
       $counting_unit_all = array();
            foreach($countingUnitsAll as $counting_unit1){
            //Specs
                $design1 = Design::find($counting_unit1->design_id);
                $fabric1 = Fabric::find($counting_unit1->fabric_id);
                $colour1 = Colour::find($counting_unit1->colour_id);
                $size1 = Size::find($counting_unit1->size_id);
                $gender1 = Gender::find($counting_unit1->gender_id);
            //

            $id1 = $counting_unit1->id;
            $unit_code1 = $counting_unit1->unit_code;
            $unit_name1 = $counting_unit1->unit_name;
            $design_name1 = $design1->design_name;
            $fabric_name1 = $fabric1->fabric_name ?? 'Fabric is Null';
            $colour_name1 = $colour1->colour_name;
            $size_name1 = $size1->size_name;
            $gender_name1 = $gender1->gender_name;
            $current_quantity1 = $counting_unit1->current_quantity;
            $order_price1 = $counting_unit1->order_price;
            $purchase_price1 = $counting_unit1->purchase_price;
            $item_id1 = $counting_unit1->item_id;
            $combined1 = array('id' => $id1, 'unit_code' => $unit_code1, 'unit_name' => $unit_name1, 'design_name' => $design_name1, 'fabric_name' =>$fabric_name1, 'colour_name' => $colour_name1, 'size_name' => $size_name1, 'gender_name' => $gender_name1, 'current_quantity' => $current_quantity1, 'order_price' => $order_price1, 'purchase_price' => $purchase_price1, 'item_id' => $item_id1);

            array_push($counting_unit_all, $combined1);

            }
            //----------------------------

            // Htet Wai Lwin (mobile only)
            $counting_unit_list_update = array();
            foreach($countingUnits as $counting_unit){
            //Specs
                $design = Design::find($counting_unit->design_id);
                $fabric = Fabric::find($counting_unit->fabric_id);
                $colour = Colour::find($counting_unit->colour_id);
                $size = Size::find($counting_unit->size_id);
                $gender = Gender::find($counting_unit->gender_id);
            //

            $id = $counting_unit->id;
            $unit_code = $counting_unit->unit_code;
            $unit_name = $counting_unit->unit_name;
            $design_name = $design->design_name;
            $fabric_name = $fabric->fabric_name ?? 'Fabric is Null';
            $colour_name = $colour->colour_name;
            $colour_description = $colour->colour_description;
            $size_name = $size->size_name;
            $gender_name = $gender->gender_name;
            $current_quantity = $counting_unit->current_quantity;
            $order_price = $counting_unit->order_price;
            $purchase_price = $counting_unit->purchase_price;
            $item_id = $counting_unit->item_id;
            $combined = array('id' => $id, 'unit_code' => $unit_code, 'unit_name' => $unit_name, 'design_name' => $design_name, 'fabric_name' =>$fabric_name, 'colour_name' => $colour_name,'colour_description' => $colour_description, 'size_name' => $size_name, 'gender_name' => $gender_name, 'current_quantity' => $current_quantity, 'order_price' => $order_price, 'purchase_price' => $purchase_price, 'item_id' => $item_id);

            array_push($counting_unit_list_update, $combined);

            }
        //-------------------------

        // Htet Wai Lwin (mobile only)

        $counting_unit_all_update = array();
        foreach($countingUnitsAll as $counting_unit1){
        //Specs
            $design1 = Design::find($counting_unit1->design_id);
            $fabric1 = Fabric::find($counting_unit1->fabric_id);
            $colour1 = Colour::find($counting_unit1->colour_id);
            $size1 = Size::find($counting_unit1->size_id);
            $gender1 = Gender::find($counting_unit1->gender_id);
        //

        $id1 = $counting_unit1->id;
        $unit_code1 = $counting_unit1->unit_code;
        $unit_name1 = $counting_unit1->unit_name;
        $design_name1 = $design1->design_name;
        $fabric_name1 = $fabric1->fabric_name ?? 'Fabric is Null';
        $colour_name1 = $colour1->colour_name;
        $colour_description1 = $colour1->colour_description;
        $size_name1 = $size1->size_name;
        $gender_name1 = $gender1->gender_name;
        $current_quantity1 = $counting_unit1->current_quantity;
        $order_price1 = $counting_unit1->order_price;
        $purchase_price1 = $counting_unit1->purchase_price;
        $item_id1 = $counting_unit1->item_id;
        $combined1 = array('id' => $id1, 'unit_code' => $unit_code1, 'unit_name' => $unit_name1, 'design_name' => $design_name1, 'fabric_name' =>$fabric_name1, 'colour_name' => $colour_name1,'colour_description'=>$colour_description1, 'size_name' => $size_name1, 'gender_name' => $gender_name1, 'current_quantity' => $current_quantity1, 'order_price' => $order_price1, 'purchase_price' => $purchase_price1, 'item_id' => $item_id1);

        array_push($counting_unit_all_update, $combined1);

        }

       //========================

       return response()->json(["item" => $item,"counting_units" =>$counting_unit_list,"counting_units_update"=> $counting_unit_list_update,"counting_unit_all_update"=>$counting_unit_all_update,"counting_unit_all"=>$counting_unit_all,"valueofinstock" => $valueofinstock, "valueofpreorder"=>$valueofpreorder]);
   }
}
