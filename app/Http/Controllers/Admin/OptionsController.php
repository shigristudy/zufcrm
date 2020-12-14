<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Support\Facades\Validator;

class OptionsController extends Controller
{

    public function fetch( Request $request ){
        $columns = ['id','key','value'];
        
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Option::select($columns)->orderBy($columns[$column], $dir);

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

    public function edit(Request $request){

        $data = Option::findOrFail($request->id);
        return response()->json([
            'success' => 1,
            'data'    => $data
        ]);
    }

    public function store(Request $request){
        
        $this->validate($request, [
            'key' => 'required',
            'value' => 'required',
        ]);
        $opt = Option::set($request->key,$request->value);
        return response()->json([
            'success' => 1,
            'data'    => $opt,
            'message' => 'Option Updated Successfully'  
        ]);
    }
}
