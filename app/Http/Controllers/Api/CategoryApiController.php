<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Category;
use App\Getlocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiBaseController;
use App\SubCategory;

class CategoryApiController extends ApiBaseController
{
   public function index(){
       $categories = Category::where('type_flag',1)->wherein('id',[1,2,3,4,5])->get();
       //========================

       //========================
       return response()->json($categories);
   }

   public function getCategory(){
       $categories = Category::all();
       //========================

       //========================
       return response()->json($categories);
   }

   public function getCategoryId($id){
    $items = Item::where('category_id',$id)->where('instock',1)->get();
    $sub = SubCategory::where('category_id',$id)->get();

    return response()->json([
        'items' => $items,
        'subs' => $sub,
    ]);
}

    public function getItembySub($cid,$sid){
        $items = Item::where('category_id',$cid)->where('sub_category_id',$sid)->where('instock',1)->get();

        return response()->json([
            'items' => $items
        ]);
    }
}
