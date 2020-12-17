<?php

use App\Models\OrderItem;
use App\Models\WooOrder;
use App\Models\WooProduct;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
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
Route::get('/hello', function () {
    return 'hello';
});
Route::get('/testing', function () {
    // dd(1);
   
    $client = new Client();
    $response = $client->request('GET', 'https://www.ziaulummahfoundation.org.uk/wp-json/getdonations/v1/get_all_donations');
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
        $response = $client->request('GET', 'https://www.ziaulummahfoundation.org.uk/wp-json/wc/v3/products?per_page=100',[
                        'auth' => [
                            'ck_4202435a3ffa2878c84d3064e2e5463f7a234589', 
                            'cs_91b6f3fd2894b1a818f8c38e912ca56756b88ba6'
                        ]
                    ]);
        // echo $response->getStatusCode(); // 200
        // echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
        // echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'

        foreach(json_decode($response->getBody(),true) as $value){
            $woo = new WooProduct();
            $woo->product_id    = $value['id'];
            $woo->name          = $value['name'];
            $woo->type          = $value['type'];
            $woo->price         = ($value['price'] && $value['price'] != '') ?? 0;
            $woo->childs        = ( isset($value['_children']) ) ? json_encode($value['_children']) : null;
            $woo->save();
        }

        DB::commit();
        
    } catch (\Exception $e) {
        DB::rollback();
        return $e;
    }
    
});
