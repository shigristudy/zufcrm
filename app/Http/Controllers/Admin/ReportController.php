<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
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
        // dd($request->all());
        $columns = ['id','order_id','woo_order_id','product_id','name','donation_type','quantity','total','type','is_sponsor','allocated_at'];
        
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
            $project            = $filters["product_id"];
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
            if($project){
                $query->where('product_id',$project);
            }

            if($donation_type){
                $query->where('donation_type', 'like', '%' . $donation_type . '%');
            }
        }
        // dd($query->toSql());
        // select `id`, `order_id`, `woo_order_id`, `product_id`, `name`, `donation_type`, `quantity`, `total`, `type`, `is_sponsor`, `allocated_at` from `order_items` where exists (select * from `woo_products` where `order_items`.`product_id` = `woo_products`.`product_id` and `type` = ?) order by `id` desc
        if ($searchValue) {
            $query->where(function($query) use ($searchValue,$columns) {
                
                foreach($columns as $c){
                    $query->orWhere($c, 'like', '%' . $searchValue . '%');
                }
                // $query->whereHas('order',function($q) use ($searchValue){
                //     return $q->where('postcode',$searchValue);        
                // });
            });
        }
        // dd($query->toSql());
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];

    }

    public function monthly_donations(Request $request){
        $columns = ['id','order_id','woo_order_id','product_id','name','donation_type','quantity','total','type','is_sponsor','allocated_at'];
        
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
            $project            = $filters["product_id"];
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
            if($project){
                $query->where('product_id',$project);
            }

            if($donation_type){
                $query->where('donation_type', 'like', '%' . $donation_type . '%');
            }
        }
        if ($searchValue) {
            $query->where(function($query) use ($searchValue,$columns) {
                foreach($columns as $c){
                    $query->where($c, 'like', '%' . $searchValue . '%');
                }
            });
        }

        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];

    }
}
