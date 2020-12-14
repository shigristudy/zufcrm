<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class PermissionController extends Controller
{

    public function fetch(Request $request){
        $columns = ['id','name','display_name','description'];
        
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Permission::select($columns)
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


    public function getAllPermissions(){
        $data = Permission::where('parent',0)->orderBy('id','desc')->get();
        return response()->json(
            [
                'success' => 1,
                'data'    => $data
            ]
        );
    }

    public function getAllPermissionsWithGroup( Request $request ){
        $role_data = Role::find($request->role_id);
        $data = Permission::where('parent',0)->with('children')->get();
        $rolesPermission = PermissionRole::with('permission:id,name,display_name')->where('role_id', $request->role_id)->get();
        return response()->json(
            [
                'success' => 1,
                'message' => 'Permissions Updated',  
                'data'    => $data,
                'role_data' => $role_data,
                'rolesPermissions'=>$rolesPermission
            ]
        );
    }

    public function assignPermission(Request $request){
        // dd($request->all());
        $main_permissions = $request->permissions['main'];
        
        DB::table("permission_role")->where("permission_role.role_id", $request->role_id)->delete();
        $role = Role::findOrFail($request->role_id);
        
        if ( count( $main_permissions ) > 0 ){
            foreach($main_permissions as $k => $val){
                $role->attachPermission($val);
            }
        }

        $permissions = PermissionRole::with('permission:id,name,display_name')->where('role_id', $request->role_id)->get();
        return response()->json(
            [
                'success' => 1,
                'message' => 'Permissions Updated',  
                'data'    => $permissions
            ]
        );
    }


    public function getUserPermissions(){
        
        $role = Role::where('name',auth()->user()->role)->first();
        $permissions = PermissionRole::with('permission:id,name,display_name')->where('role_id',$role->id)->get();
        return $permissions;
    }

    // Roles Store to DB
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions',
            'display_name' => 'required',
            'description' => 'required',
        ]);
         
        $data = New Permission;
        $data->name         = $request->name;
        $data->display_name = $request->display_name;
        $data->description  = $request->description;
        $data->save();

        $success = 'Permission has been created.';
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
        
        $data = Permission::findOrFail($request->edit_id);
        $data->display_name = $request->display_name;
        $data->description  = $request->description;
        $data->save(); 
        
        $success = 'Permission has been updated.';
        return response()->json([
                'success'   =>  1,
                'message'   =>  $success,
        ]);
    }

    public function edit($id)
    {
      $data = Permission::findOrFail($id);
      return response()->json(['success'=>1,'message'=>'Found Data','data'=>$data]);

    }
    

    // Permission Delete from DB
    public function destroy($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            DB::table("permission_role")->where('permission_id', $id)->delete();
            $permission->delete();
            return response()->json([
                'success' => 1,
                'message' => "The Role <strong>$permission->name</strong> has successfully been archived."  
            ]);
            
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->json([
                    'success' => 0,
                    'message' => "something Went wrong!"  
                ]);
            }
        }
    }
}
