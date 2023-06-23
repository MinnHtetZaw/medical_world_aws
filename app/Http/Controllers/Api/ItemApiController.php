<?php

namespace App\Http\Controllers\Api;

use App\Getlocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiBaseController;
use App\Category;
use App\SubCategory;
use App\Item;
use App\CountingUnit;
use App\FacebookLink;
use App\YoutubeLink;
use App\PromotionPhoto;


class ItemApiController extends ApiBaseController
{
   public function index(){
       $items = Item::where('instock',1)->get();
       //========================
       $item_list = array();
            foreach($items as $item){
            //Category
                $category = Category::find($item->category_id);
            //
             //SubCategory
                $subcategory = SubCategory::find($item->sub_category_id);
            //

            $id = $item->id;
            $item_code = $item->item_code;
            $item_name = $item->item_name;
            $customer_console = $item->customer_console;
            $unit_name = $item->unit_name;
            $category_name = $category->category_name;
            $subcategory_name = $subcategory->name;

            $combined = array('id' => $id, 'item_code' => $item_code, 'item_name' => $item_name, 'customer_console' => $customer_console, 'unit_name' =>$unit_name, 'category_name' => $category_name, 'subcategory_name' => $subcategory_name);

            array_push($item_list, $combined);

            }
       //========================
       return response()->json([
           "data" => $item_list,
           "items" => $items,
           ]);
   }

   public function getItemByProductLine(Request $request){

       $item = Item::find($request->item_id);
       if($item->related_item_id == null){
        $items = Item::where('sub_category_id',$request->subcategory_id)->get();
        // $items = SubCategory::where('category_id',$request->category_id)->get();
       }else{
        $it = explode(',',$item->related_item_id);
        $items  = [];
        foreach($it as $t){
            $arr = Item::find($t);
            array_push($items,$arr);
        }
       }
       return response()->json($items);
   }

   public function getNewArrivalItems(){
       $item_list = Item::where('new_product_flag',1)->get();
       return response()->json($item_list);
   }

   public function getPromotionItems(){
       $item_list = Item::where('promotion_product_flag',1)->get();
       return response()->json($item_list);
   }
   public function getHotSaleItems(){
       $item_list = Item::where('hot_sale_flag',1)->get();
       return response()->json($item_list);
   }
   public function getOrderPrice($id) {
        $order_price = CountingUnit::where('item_id',$id)->first('order_price');
        return response()->json($order_price);
    }
    public function getPromoPrice($id) {
        $order_price = CountingUnit::where('item_id',$id)->first('order_price');
        $percentage = Item::where('id', $id)->first('discount_price');
        $promo_set = ($order_price->order_price / 100) * $percentage->discount_price;
        $promo_price = $order_price->order_price - $promo_set;
        return response()->json($promo_price);
    }

    public function detail($id){
        $item = Item::where('sub_category_id',$id)->first();
        return response()->json($item);
    }

    public function facebook(){
        $facebook = FacebookLink::all();
        return response()->json($facebook);
    }

    public function youtube(){
        $youtube = YoutubeLink::all();
        return response()->json($youtube);
    }

    public function promotionphoto(){
        $promotionphoto = PromotionPhoto::all();
        return response()->json($promotionphoto);

    }
}
