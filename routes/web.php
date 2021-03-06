<?php

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\GocardlessController;
use App\Models\OrderItem;
use App\Models\WooOrder;
use App\Models\WooProduct;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::post('gocardless_webhook', function (Request $request) {
//     Log::info($request);
//     return 'hello';
// })->withoutMiddleware(['csrf']);
Route::get('/shigri',function (){


    $order = WooOrder::where('order_id',13383)
                                ->update([
                                    'submitted' => null,
                                    'claimed'   => null,
                                ]);
    dd($order);
    $donations = OrderItem::with(['order','product'])
                ->whereHas('product',function($q){
                   return $q->where('type','simple');
                })
                ->whereIn('product_id',[11863, 11864, 11814, 11815, 11816])

                ->get();

    return response()->json($donations);
});


Route::get('/testing', function () {
    dd(1);

    $client = new Client();
    $response = $client->request('GET', 'https://www.staging5.ziaulummahfoundation.org.uk//wp-json/getdonations/v1/get_all_donations');
    DB::beginTransaction();
    try {
        foreach(json_decode($response->getBody(),true) as $value){

            $woo = new WooOrder();
            $woo->order_id                  = $value['order_id'];
            $woo->order_total               = $value['order_total'];
            $woo->is_sponsor_count          = $value['is_sponsor_count'];
            $woo->title                     = $value['title'];
            $woo->donation_date             = $value['donation_date'];
            $woo->number_of_items           = $value['number_of_items'];
            $woo->gift_aid                  = ($value['gift_aid'] == 'Yes') ? "Yes" : "No";
            $woo->title                     = $value['billing_title'];
            $woo->first_name                = $value['first_name'];
            $woo->last_name                 = $value['last_name'];
            $woo->company                   = $value['company'];
            $woo->address_1                 = $value['address_1'];
            $woo->address_2                 = $value['address_2'];
            $woo->city                      = $value['city'];
            $woo->state                     = $value['state'];
            $woo->postcode                  = $value['postcode'];
            $woo->country                   = $value['country'];
            $woo->email                     = $value['email'];
            $woo->phone                     = $value['phone'];
            $woo->payment_method            = $value['payment_method'];
            $woo->payment_method_title      = $value['payment_method_title'];

            $woo->save();

            // insert order items
            foreach($value['order_items'] as $item ){

                $Orderitem = new OrderItem();
                $Orderitem->order_id         = $woo->id;
                $Orderitem->woo_order_id     = $item['order_id'];
                $Orderitem->product_id       = $item['product_id'];
                $Orderitem->name             = $item['name'];
                $Orderitem->quantity         = $item['quantity'];
                $Orderitem->total            = $item['total'];
                $Orderitem->type             = $item['type'];
                $Orderitem->is_sponsor       = $item['is_sponsor'];
                $Orderitem->donation_type    = $item['donation_type'];
                $Orderitem->save();
            }
        }
        DB::commit();

    } catch (\Exception $e) {
        DB::rollback();
        return $e;
    }

});

Route::get('/import-products', function () {
    // dd(1);
    DB::beginTransaction();

    try {
        $client = new Client();

        $response = $client->request('GET', 'https://www.ziaulummahfoundation.org.uk/wp-json/getproducts/v1/get_all_products');

        foreach(json_decode($response->getBody(),true) as $value){
            if(!WooProduct::where('product_id',$value['product_id'])->first()){
                if($value['product_id']){

                    $woo = new WooProduct();
                    $woo->product_id            = $value['product_id'];
                    $woo->name                  = $value['name'];
                    $woo->type                  = $value['type'];
                    $woo->price                 = ($value['price'] && $value['price'] != '') ?? 0;
                    $woo->childs                =  null;
                    $woo->project_page          = $value['project_page'];
                    $woo->save();
                }
            }
        }

        DB::commit();

    } catch (\Exception $e) {
        DB::rollback();
        return $e;
    }


});


Route::get('pdf_generator',[GocardlessController::class,'pdf_generator']);
Route::get('view_reports/{id}',[ReportController::class,'viewReports']);
Route::get('download_reports/{id}',[ReportController::class,'downloadReports']);
Route::get('send_reports/{id}',[ReportController::class,'sendReports']);

Route::get('gocardless_testing',[GocardlessController::class,'gocardless_testing']);
