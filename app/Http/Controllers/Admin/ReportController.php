<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\OrderItem;
use App\Models\Report;
use App\Models\Student;
use App\Models\WooOrder;
use App\Models\WooProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function dashboard(Request $request){

        $not_claimed_count = WooOrder::giftaid()
                    ->notClaimed()
                    ->notSubmitted()
                    ->count();
        $claimed_count = WooOrder::giftaid()
                    ->claimed()
                    ->submitted()
                    ->count();
        $submitted_count = WooOrder::giftaid()
                    ->notClaimed()
                    ->submitted()
                    ->count();
        $reports_count =   Report::count();   
        
        $hafiz_students = Student::where('student_type','hafiz')->count();
        $scolar_students = Student::where('student_type','scolar')->count();

        // income raised per year *
        // top project with most donations *
        // pie chart with donation type
        // number of unallocated sponshorships *
        // unclaimed gift aid donations (number) *
        
        $no_of_unallocated_spons = OrderItem::where('is_sponsor',1)->where('allocated_at',null)->count();
        $total_income_raised_this_year = WooOrder::year(date('Y'))->sum('order_total');
        $total_income_raised = WooOrder::sum('order_total');
        $top_projects = OrderItem::with('product')->select(['product_id',DB::raw("SUM(total) as total_amount"), DB::raw("COUNT(product_id) as total_donations")])
                        ->groupBy('product_id')
                        ->orderBy('total_donations','desc')
                        ->limit(5)->get();

        $donation_types = array_map('trim', explode(',',Option::get('donation_types')));
        $series_data = OrderItem::select(['donation_type',DB::raw("COUNT(donation_type) as total_donations")])
                        ->where('donation_type','!=',null)
                        ->groupBy('donation_type')
                        ->orderBy('total_donations','desc')->get();
        $series_labels = $series_data->pluck('donation_type');
        $series        = $series_data->pluck('total_donations');
        
        
        // dd($series_labels,$series);
        $response = [
            'not_claimed_count' => $not_claimed_count,
            'claimed_count'     => $claimed_count,
            'submitted_count'   => $submitted_count,
            'reports_count'     => $reports_count,
            'hafiz_students'    => $hafiz_students,
            'scholar_students'  => $scolar_students,
            'top_projects'      => $top_projects,
            'no_of_unallocated_spons' => $no_of_unallocated_spons,
            'total_income_raised_this_year' => $total_income_raised_this_year,
            'total_income_raised' => $total_income_raised,
            'series_labels' => $series_labels,
            'series' => $series,
        ];
        return response()->json($response);
    }

    public function reports(Request $request){

        $query = Report::where('title', '!=', 'hell');
        if ($request->search && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
            $query->where('note', 'like', '%' . $request->search . '%');
        }
        $query = $query->paginate(12);

        $response = [
            'pagination' => [
                'total' => $query->total(),
                'per_page' => $query->perPage(),
                'current_page' => $query->currentPage(),
                'last_page' => $query->lastPage(),
                'from' => $query->firstItem(),
                'to' => $query->lastItem()
            ],
            'data' => $query
        ];
        return response()->json($response);
    }

    public function one_off_donations(Request $request){
        // dd();
        $columns = ['id','order_id','woo_order_id','product_id','name','donation_type','quantity','type','total','is_sponsor','allocated_at'];
        
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = OrderItem::with(['order','product'])->select($columns)
                    ->whereHas('product',function($q){
                        return $q->where('type','simple');        
                    })
                    ->orderBy($columns[$column], $dir);
        if($request->filtering){

            $filters = json_decode($request->form,true);
            $projects           = array_column($filters['product_id'], 'product_id');
            $date_from          = ($filters["date_from"]);
            $date_to            = ($filters["date_to"]);
            $donation_type      = ($filters["donation_type"]);
            
            if($date_from || $date_to){
                
                if($date_from && $date_to){
                    $query->whereHas('order',function($q) use($date_from,$date_to){
                        return $q->whereBetween('donation_date',[$date_from,$date_to]);        
                    });
                    // $query->whereBetween('donation_date',[$date_from,$date_to]);
                }else if($date_from){
                    $query->whereHas('order',function($q) use($date_from,$date_to){
                        return $q->whereDate('donation_date','>',$date_from);       
                    });
                    // $query->whereDate('donation_date','>',$date_from);
                }else{
                    $query->whereHas('order',function($q) use($date_from,$date_to){
                        return $q->whereDate('donation_date','<',$date_to);       
                    });
                    // $query->whereDate('donation_date','<',$date_to);
                }
            }
            if(count($projects)>0){
                $query->whereIn('product_id',$projects);
            }

            if($donation_type){
                $query->where('donation_type', 'like', '%' . $donation_type . '%');
            }
        }


        if ($searchValue) {
            $orderinfo_ids = WooOrder::where('first_name','like', '%' .$searchValue . '%')
                                ->orWhere('last_name','like', '%' .$searchValue . '%')        
                                ->orWhere('email','like', '%' .$searchValue . '%')        
                                ->orWhere('postcode','like', '%' .$searchValue . '%')        
                                ->orWhere('city','like', '%' .$searchValue . '%')        
                                ->orWhere('phone','like', '%' .$searchValue . '%')        
                                ->orWhere('address_1','like', '%' .$searchValue . '%')        
                                ->orWhere('address_2','like', '%' .$searchValue . '%')->get()->pluck('order_id');

            $query->whereIn('woo_order_id',$orderinfo_ids);
            $query->orWhere('name','like','%'. $searchValue .'%')->orWhere('donation_type','like','%'. $searchValue .'%');            
        }

        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];

    }

    public function monthly_donations(Request $request){
        $columns = ['id','order_id','woo_order_id','product_id','name','donation_type','quantity','type','total','is_sponsor','allocated_at'];
        
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = OrderItem::with(['order','product'])->select($columns)
                    ->whereHas('product',function($q){
                        return $q->where('type','subscription');        
                    })
                    ->orderBy($columns[$column], $dir);

        if($request->filtering){

            $filters = json_decode($request->form,true);
            $projects           = array_column($filters['product_id'], 'product_id');
            $date_from          = ($filters["date_from"]);
            $date_to            = ($filters["date_to"]);
            $donation_type      = ($filters["donation_type"]);
            
            if($date_from || $date_to){
                
                if($date_from && $date_to){
                    $query->whereHas('order',function($q) use($date_from,$date_to){
                        return $q->whereBetween('donation_date',[$date_from,$date_to]);        
                    });
                }else if($date_from){
                    $query->whereHas('order',function($q) use($date_from,$date_to){
                        return $q->whereDate('donation_date','>',$date_from);       
                    });
                }else{
                    $query->whereHas('order',function($q) use($date_from,$date_to){
                        return $q->whereDate('donation_date','<',$date_to);       
                    });
                }
            }
            if(count($projects)>0){
                $query->whereIn('product_id',$projects);
            }

            if($donation_type){
                $query->where('donation_type', 'like', '%' . $donation_type . '%');
            }
        }
        if ($searchValue) {
            $orderinfo_ids = WooOrder::where('first_name','like', '%' .$searchValue . '%')
                                ->orWhere('last_name','like', '%' .$searchValue . '%')        
                                ->orWhere('email','like', '%' .$searchValue . '%')        
                                ->orWhere('postcode','like', '%' .$searchValue . '%')        
                                ->orWhere('city','like', '%' .$searchValue . '%')        
                                ->orWhere('phone','like', '%' .$searchValue . '%')        
                                ->orWhere('address_1','like', '%' .$searchValue . '%')        
                                ->orWhere('address_2','like', '%' .$searchValue . '%')->get()->pluck('order_id');

            $query->whereIn('woo_order_id',$orderinfo_ids);
            $query->orWhere('name','like','%'. $searchValue .'%')->orWhere('donation_type','like','%'. $searchValue .'%');            
        }

        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];

    }

    public function includeProductInSponsorhips( Request $request ){
        
        $count = count($request->selectedrows);

        OrderItem::whereIn('id',$request->selectedrows)->update([
            'is_sponsor' => 1
        ]);

        return response()->json([
            'success'   => 1,
            'message'   => "{$count} Donations has been included in Sponsorhips"    
        ]);
    }
}
