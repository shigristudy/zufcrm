<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\WooOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GiftAidController extends Controller
{
    public function getAllDonationsWithGiftaid(Request $request){
        $columns = ['id','gift_aid','first_name','order_total','last_name','email','phone','payment_method','submitted','claimed','is_allocated'];
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        
        $query = WooOrder::with('items.product')
                    ->giftaid()
                    ->where('claimed',null)
                    ->where('submitted',null)
                    ->orderBy($columns[$column], $dir);
                    

        if ($searchValue) {
            $query->where(function($query) use ($searchValue,$columns) {
                foreach($columns as $c){
                    $query->orWhere($c, 'like', '%' . $searchValue . '%');
                }
            });
        }

        if ($length == 'all' ) {
            $length = $query->count();
        }

        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function submittedGiftAidsList(Request $request){
        // dd($request->all());
        $columns = ['id','is_allocated','gift_aid','first_name','last_name','email','phone','payment_method','donation_date','order_total','claimed'];
        
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = WooOrder::with('items.product')
                    ->giftaid()
                    ->where('claimed',null)
                    ->where('submitted','!=',null)
                    ->orderBy($columns[$column], $dir);
                    // dd($query->toSql());
        if ($searchValue) {
            $query->where(function($query) use ($searchValue,$columns) {
                foreach($columns as $c){
                    $query->orWhere($c, 'like', '%' . $searchValue . '%');
                }
            });
        }
        if ($length == 'all' ) {
            $length = $query->count();
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function getAllClaimedDonations(Request $request){
        
        $columns = ['id','order_total','gift_aid','first_name','last_name','email','phone','payment_method','submitted','claimed','is_allocated'];
        
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = WooOrder::with('items.product')
                    ->where('report_id',$request->id)
                    ->giftaid()
                    ->claimed()
                    ->submitted()
                    ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue,$columns) {
                foreach($columns as $c){
                    $query->orWhere($c, 'like', '%' . $searchValue . '%');
                }
            });
        }
        if ($length == 'all' ) {
            $length = $query->count();
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function markAllDonationsAsGiftAid(Request $request){
        // dd($request->all());
        if(count($request->selectedrows) > 0 ){
            $ids = $request->selectedrows;
        
            $giftaids = WooOrder::whereIn('id',$ids)
                        ->update([
                            'submitted'   => now(),
                            'claimed'   => null,
                        ]);
        }else{
            $giftaids = WooOrder::giftaid()
                    ->notClaimed()
                    ->notSubmitted()
                    ->update([
                        'submitted'   => now(),
                        'claimed'   => null,
                    ]);
        }
        
        return response()->json([
            'success'   => 1,
            'message'   => 'Selected donations transfered to Make A Claim'
        ]);
    }

    public function markAllSelectedasClaimed(Request $request){
           
        $report = new Report();
        $report->user_id = auth()->user()->id;
        $report->title   = $request->title;
        $report->note    = $request->note;
        $report->save();

        $giftaids = WooOrder::giftaid()
                    ->submitted()
                    ->where('report_id',null)
                    ->update([
                        'claimed'   => now(),
                        'report_id' => $report->id
                    ]);
        return response()->json([
            'success'   => 1,
            'data'      => $giftaids,
            'message'   => 'All Donations has been Marked as Closed/Claimed Successfully!'
        ]);
    }


    public function markAllSelectedasNew(Request $request){
        $this->validate($request, [
            'selectedrows' => 'required',
        ]);
        
        $ids = $request->selectedrows;
        
        $giftaids = WooOrder::whereIn('id',$ids)
                    ->update([
                        'claimed'       => null,
                        'submitted'     => null,
                    ]);
        return response()->json([
            'success'   => 1,
            'data'      => $giftaids,
            'message'   => 'Successfully removed selection donations from this claim'
        ]);
    }

    public function closeAllGeneratedDonations(Request $request){
        dd($request->all());
    }
    public function editOrderDetails(Request $request){
        
        DB::beginTransaction();

        try {
            $this->validate($request, [
                "title"         => 'required',
                "donation_date" => 'required',
                "order_total"   => 'required',
                "first_name"    => 'required',
                "last_name"     => 'required',
                "address_1"     => 'required',
                "postcode"      => 'required',
            ]);
            $woo_order = WooOrder::find($request->order_id);
            
            $var = $request->donation_date;//'20/04/2012';
            $date = str_replace('/', '-', $var);
            $donation_date = date('Y-m-d', strtotime($date));

            
            $woo_order->title           = $request->title;
            $woo_order->first_name      = $request->first_name;
            $woo_order->last_name       = $request->last_name;
            $woo_order->address_1       = $request->address_1;
            $woo_order->address_2       = $request->address_2;
            $woo_order->postcode        = $request->postcode;
            $woo_order->order_total     = $request->order_total;
            $woo_order->donation_date   = $donation_date;

            $woo_order->save();

            DB::commit();
            return response()->json([
                'success'   => 1,
                'data'      => $woo_order,
                'message'   => 'Donation Has been Updated!'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
}
