<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ContactMessageController;
use App\Http\Controllers\Api\MailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/



Route::post('Login', 'Api\LoginController@loginProcess');
Route::post('usercontrol', 'Api\LoginController@usercontrol');
Route::get('countingunitapi', 'Api\CountingUnitApiController@index');
Route::get('unitbyid_api/{id}', 'Api\CountingUnitApiController@getUnitById');
Route::get('subcategory_api', 'Api\SubcategoryApiController@index');
Route::get('subcategory_api/{id}', 'Api\SubcategoryApiController@getSubcategoryById');
Route::get('category_api', 'Api\CategoryApiController@index');
Route::get('category_api/{cid}/{sid}', 'Api\CategoryApiController@getItembySub');
Route::get('category_all', 'Api\CategoryApiController@getCategory');
Route::get('category_all/{id}', 'Api\CategoryApiController@getCategoryId');

Route::get('facebook', 'Api\ItemApiController@facebook');
Route::get('promotionphoto', 'Api\ItemApiController@promotionphoto');

Route::get('item_api', 'Api\ItemApiController@index');
Route::get('item_api/{id}', 'Api\ItemApiController@detail');
Route::get('newitem_api', 'Api\ItemApiController@getNewArrivalItems');
Route::get('promotionitem_api', 'Api\ItemApiController@getPromotionItems');
Route::get('hotsaleitem_api', 'Api\ItemApiController@getHotSaleItems');
Route::get('orderprice_api/{id}', 'Api\ItemApiController@getOrderPrice');
Route::get('promoprice_api/{id}', 'Api\ItemApiController@getPromoPrice');

//heinhtetlinn
Route::get('facebook', 'Api\ItemApiController@facebook');
Route::get('youtube', 'Api\ItemApiController@youtube');
Route::get('promotionphoto', 'Api\ItemApiController@promotionphoto');

//////
Route::get('ecommerce_order_type_color/{fabric}/{flag}','Api\EcommerceOrderApiController@colourapi');
Route::post('productlineitems_api', 'Api\ItemApiController@getItemByProductLine');
Route::get('website_user_index', 'Api\WebsiteUserApiController@index');
Route::post('website_user_store', 'Api\WebsiteUserApiController@store');
Route::get('ecommerce_order_index', 'Api\EcommerceOrderApiController@index');
Route::get('design_api/{id}', 'Api\EcommerceOrderApiController@getdesignname');
Route::get('designapi/{id}','Api\EcommerceOrderApiController@getdesignapiname');
Route::get('ecommerce_order_type/{name}', 'Api\EcommerceOrderApiController@type');
Route::get('ecommerce_order_type/{name}/{gender}', 'Api\EcommerceOrderApiController@typegender');
Route::get('ecommerce_order_type/{name}/{gender}/{fabric}', 'Api\EcommerceOrderApiController@typefabric');
Route::get('ecommerce_order_type1/{name}/{gender}/{fabric}', 'Api\EcommerceOrderApiController@typefabric1');
Route::get('ecommerce_order_type/{name}/{gender}/{fabric}/{colour}', 'Api\EcommerceOrderApiController@typecolour');
Route::get('ecommerce_order_detail/{id}', 'Api\EcommerceOrderApiController@detail');
Route::post('ecommerce_order_store', 'Api\EcommerceOrderApiController@store');
Route::post('searchitem', 'Api\EcommerceOrderApiController@searchitem');
Route::post('storescreenshot', 'Api\EcommerceOrderApiController@storescreenshot');
Route::post('storepayment', 'Api\EcommerceOrderApiController@storepayment');
Route::post('showprice', 'Api\EcommerceOrderApiController@showprice')->name('showprice');
Route::post('ecommerce_preorder_store', 'Api\EcommerceOrderApiController@preorderstore');
Route::post('ecommerce_attachorder_store', 'Api\EcommerceOrderApiController@attachorderstore');
Route::post('ecommerce_attach_store', 'Api\EcommerceOrderApiController@attachstore');
Route::get('township', 'Api\EcommerceOrderApiController@township');
Route::get('township_charges/{id}', 'Api\EcommerceOrderApiController@township_charges');
Route::post('send/invoice_email', 'Api\EcommerceOrderApiController@invoice_mail')->name('invoice_email');

Route::post('contact_message', 'Api\ContactMessageController@contact_message')->name('contact_message');


Route::group(['middleware' => ['auth:api','CustomerPermissionAPI']], function () {

	Route::post('Logout', 'Api\LoginController@logoutProcess');

	Route::post('updatePassword', 'Api\LoginController@updatePassword');

	Route::post('editProfile', 'Api\CustomerController@editProfile');

	Route::post('getItemListbyCategory', 'Api\CustomerController@getItemListbyCategory');

	Route::post('getCountingUnit', 'Api\CustomerController@getCountingUnit');

	Route::post('storeOrder', 'Api\CustomerController@storeOrder');

	Route::post('getOrderList', 'Api\CustomerController@getOrderList');

	Route::post('getOrderDetails', 'Api\CustomerController@getOrderDetails');

	Route::post('changeOrder', 'Api\CustomerController@changeOrder');

	Route::post('acceptOrder', 'Api\CustomerController@acceptOrder');

	Route::post('delivery/sendlocation', 'Api\DeliveryController@deliverySendlocation');

	Route::post('delivery/getlocation', 'Api\DeliveryController@deliveryGetlocation');

});




