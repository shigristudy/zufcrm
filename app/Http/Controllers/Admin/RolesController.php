<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class RolesController extends Controller
{
    public function fetch(Request $request){
        $columns = ['id','name','display_name','description'];
        
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Role::select($columns)
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

    public function getAllRoles(){
        $data = Role::orderBy('id','desc')->get();
        return response()->json(
            [
                'success' => 1,
                'data'    => $data
            ]
        );
    }

    // Roles Store to DB
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
            'display_name' => 'required',
            'description' => 'required',
        ]);
         
        $data = New Role;
        $data->name         = $request->name;
        $data->display_name = $request->display_name;
        $data->description  = $request->description;
        $data->save();

        $success = 'Role has been created.';
        $data = [
            'name'         => $data->name,
            'display_name' => $data->display_name,
            'description'  => $data->description,
        ];
        return response()->json([
                'success'   =>  1,
                'message'   =>  $success,
        ]);  
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'display_name' => 'required',
            'description' => 'required',
        ]);
        
        $data = Role::findOrFail($request->edit_id);
        $data->display_name = $request->display_name;
        $data->description  = $request->description;
        $data->save(); 
        
        $success = 'Role has been updated.';
        return response()->json([
                'success'   =>  1,
                'message'   =>  $success,
        ]);
    }
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return response()->json(['success'=>1,'message'=>'Found Data','data'=>$role]);
    }

    // Delete Roles from DB
    public function destroy(Request $request)
    {
        try {
            $role = Role::findOrFail($request->id);
            $role->users()->sync([]); // Delete relationship data
            $role->permissions()->sync([]); // Delete relationship data
            $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete
            $success = 'Role has been deleted.';
            return response()->json([
                'success' => 1,
                'message' => $success  
            ]);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->json([
                    'success' => 0,
                    'message' => 'Something went Wrong'  
                ]);
            }
        }
    }
}
