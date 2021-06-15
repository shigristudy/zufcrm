<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonationRequest;
use App\Models\Donation;
use App\Models\DonationLine;
use App\Models\OrderItem;
use App\Models\WooOrder;
use App\Models\WooProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    public function store( DonationRequest $request ){

        $is_sponsor_count = 0;
        foreach($request->donationsArray as $key => $line ){
            if(in_array($line['project'],[11863, 11864, 11814, 11815, 11816])){
                $is_sponsor_count++;
            }
        }
        DB::beginTransaction();

        try {
            $woo = new WooOrder();
            $woo->title                     = $request->title;
            $woo->order_id                  = 0;
            $woo->first_name                = $request->first_name;
            $woo->last_name                 = $request->last_name;
            $woo->order_total               = $request->total_amount;
            $woo->is_sponsor_count          = $is_sponsor_count;
            $woo->donation_date             = $request->date_of_donation;
            $woo->number_of_items           = count($request->donationsArray);
            $woo->gift_aid                  = $request->gift_aid;
            $woo->address_1                 = $request->address_line1;
            $woo->address_2                 = $request->address_line2;
            $woo->city                      = $request->city;
            $woo->state                     = $request->state;
            $woo->postcode                  = $request->postal_code;
            $woo->country                   = $request->country;
            $woo->email                     = $request->email;
            $woo->phone                     = $request->contact;
            $woo->payment_method            = $request->payment_type;
            $woo->payment_method_title      = $request->payment_type;
            $woo->donation_type             = 'offline';

            $woo->save();

            // Insert Donation Lines
            foreach($request->donationsArray as $item ){
                $is_sponsor = 0;
                if(in_array($item['project'],[11863, 11864, 11814, 11815, 11816])){
                    $is_sponsor = 1;
                }
                $Orderitem = new OrderItem();
                $Orderitem->order_id         = $woo->id;
                $Orderitem->woo_order_id     = 0;
                $Orderitem->product_id       = $item['project'];
                $Orderitem->donation_type    = $item['donation_type'];
                $Orderitem->quantity         = 1;
                $Orderitem->total            = $item['amount'];
                $Orderitem->type             = 'simple';
                $Orderitem->is_sponsor       = $is_sponsor;
                $Orderitem->save();
            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
        return response()->json([
            'success'   => 1,
            'message'   => 'Donation Added Successfully!'
        ]);
    }

    public function update( DonationRequest $request ){

        $is_sponsor_count = 0;
        foreach($request->donationsArray as $key => $line ){
            if(in_array($line['project'],[11863, 11864, 11814, 11815, 11816])){
                $is_sponsor_count++;
            }
        }
        DB::beginTransaction();

        try {

            $var = $request->date_of_donation;//'20/04/2012';
            $date = str_replace('/', '-', $var);
            $donation_date = date('Y-m-d', strtotime($date));

            $woo = WooOrder::find($request->edit_id);
            $woo->title                     = $request->title;
            $woo->order_id                  = 0;
            $woo->first_name                = $request->first_name;
            $woo->last_name                 = $request->last_name;
            $woo->order_total               = $request->total_amount;
            $woo->is_sponsor_count          = $is_sponsor_count;
            $woo->donation_date             = $donation_date;
            $woo->number_of_items           = count($request->donationsArray);
            $woo->gift_aid                  = $request->gift_aid;
            $woo->address_1                 = $request->address_line1;
            $woo->address_2                 = $request->address_line2;
            $woo->city                      = $request->city;
            $woo->state                     = $request->state;
            $woo->postcode                  = $request->postal_code;
            $woo->country                   = $request->country;
            $woo->email                     = $request->email;
            $woo->phone                     = $request->contact;
            $woo->payment_method            = $request->payment_type;
            $woo->payment_method_title      = $request->payment_type;
            $woo->donation_type             = 'offline';

            $woo->save();

            // Insert Donation Lines
            OrderItem::where('order_id',$request->edit_id)->delete();
            foreach($request->donationsArray as $item ){
                $is_sponsor = 0;
                if(in_array($item['project'],[11863, 11864, 11814, 11815, 11816])){
                    $is_sponsor = 1;
                }

                $Orderitem = new OrderItem();
                $Orderitem->order_id         = $woo->id;
                $Orderitem->woo_order_id     = 0;
                $Orderitem->product_id       = $item['project'];
                $Orderitem->donation_type    = $item['donation_type'];
                $Orderitem->quantity         = 1;
                $Orderitem->total            = $item['amount'];
                $Orderitem->type             = 'simple';
                $Orderitem->is_sponsor       = $is_sponsor;
                $Orderitem->save();
            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
        return response()->json([
            'success'   => 1,
            'message'   => 'Donation Added Successfully!'
        ]);
    }


    public function getDonations(Request $request){

        // $columns = ['id','payment_type','date_of_donation','full_name','gift_aid','city','postal_code','contact','email','address_line1','address_line2','status'];
        $columns = ['id','gift_aid','first_name','last_name','email','order_total','phone','payment_method','submitted','claimed','is_allocated'];
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = WooOrder::with('items.product')->orderBy($columns[$column], $dir);
        // Filters
        if($request->filtering){

            $filters = json_decode($request->form,true);
            $gift_aid           = $filters["gift_aid"];
            $project            = $filters["project"];
            $donation_type      = $filters["donation_type"];
            $payment_method     = $filters["payment_method"];
            $date_from          = ($filters["date_from"]);
            $date_to            = ($filters["date_to"]);
            $has_sponsored      = $filters["has_sponsored"];

            if($gift_aid != ''){
                $query->ofGiftAidType($gift_aid);
            }
            if($donation_type){
                $query->where('donation_type',$donation_type);
            }
            if($payment_method){
                $query->where('payment_method',$payment_method);
            }
            if($payment_method){
                $query->where('payment_method',$payment_method);
            }
            if($date_from || $date_to){

                if($date_from && $date_to){
                    $query->whereBetween('donation_date',[$date_from,$date_to]);
                }else if($date_from){
                    $query->whereDate('donation_date','>',$date_from);
                }else{
                    $query->whereDate('donation_date','<',$date_to);
                }
            }
        }
        if ($searchValue) {
            $woo_products = WooProduct::where('name','like','%' . $searchValue . '%')->get()->pluck('product_id');

            if(count($woo_products) > 0){
                $query->whereHas('items',function($q) use ($searchValue,$woo_products){
                    return $q->whereIn('product_id', $woo_products);
                });
            }else{
                $query->where(function($query) use ($searchValue,$columns) {
                    foreach($columns as $c){
                        $query->orWhere($c, 'like', '%' . $searchValue . '%');
                    }
                });
            }
        }
        // dd($query->toSql());
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function getSingleDonation( $id ){
        $donation = WooOrder::with(['items.product'])->find($id);
        return response()->json($donation);
    }

    public function getneworderdata(Request $request){
        Log::info($request->all());
        DB::beginTransaction();
        try {
            $value = $request->all();
            $check = WooOrder::where('order_id',$value['order_id'])->first();
            if(!$check){

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
        return response()->json($request->all());
    }


    public function getProjects(Request $request){
        if($request->type){
            $projects = WooProduct::where('type',$request->type)->orderBy('name','asc')->get();
        }else{
            $projects = WooProduct::whereIn('type',['simple','subscription'])->orderBy('name','asc')->get();
        }
        return response()->json($projects);
    }


    public function create_product_in_crm(Request $request){
        $value = $request->all();
        $check = WooProduct::where('product_id',$value['product_id'])->first();
        if(!$check){
            $woo = new WooProduct();
            $woo->product_id            = $value['product_id'];
            $woo->name                  = $value['name'];
            $woo->type                  = $value['type'];
            $woo->price                 = ($value['price'] && $value['price'] != '') ?? 0;
            $woo->childs                =  null;
            $woo->project_page          = $value['project_page'];
            $woo->save();
        }

        return response()->json($request->all());
    }



}
