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
        $columns = ['id','order_id','woo_order_id','product_id','name','donation_type','quantity','total','type','is_sponsor','allocated_at'];
        
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = OrderItem::with(['order','product'])->select($columns)
                    ->whereHas('product',function($q){
                        $q->where('type','simple');        
                    })
                    ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue,$columns) {
                foreach($columns as $c){
                    $query->orWhere($c, 'like', '%' . $searchValue . '%');
                }
            });
        }

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
                        $q->where('type','subscription');        
                    })
                    ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue,$columns) {
                foreach($columns as $c){
                    $query->orWhere($c, 'like', '%' . $searchValue . '%');
                }
            });
        }

        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];

    }
}
