<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserDetails;
use App\Models\User;
use App\Models\Role;
use App\Services\ImageOptimizer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $columns = ['role', 'name', 'email'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = User::select('id', 'name', 'email', 'role')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('role', 'like', '%' . $searchValue . '%')
                ->orWhere('name', 'like', '%' . $searchValue . '%')
                ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    // Create User Page
    public function create()
    {
        $roles = Role::all();

        $params = [
            'title' => 'Create User',
            'roles' => $roles,
        ];

        return view('admin.users.users_create')->with($params);
    }

    // Store New User
    public function store(Request $request){
        
        if(isset($request->edit_id) && ($request->edit_id !="") ) {
            
            $rules = array(
                'name'      => 'required',
                'email'     => 'required|email|unique:users,id,'.$request->edit_id.'',
            );
    
            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];
            $validator = Validator::make($data,$rules);
         
            if($validator->fails()){
                return  response()->json(['errors'=>$validator->errors()],422);
            }

            $data = User::findOrFail($request->edit_id);
            $data->name   = $request->name;
            $data->email  = $request->email;

            if($data->role != $request->role){
                $role = Role::where('name',$data->role)->first(); 
                $data->detachRole($role);       
                $role = Role::where('name',$request->role)->first(); 
                $data->attachRole($role);   
            }
            
            $data->role   = $request->role;
            if($request->password){
                $data->password     = bcrypt($request->password);
            }
            

            $data->save(); 

            $userDetails =  new UserDetails();
            $userDetails->user_id = $data->id;

            
            if ($request->hasfile('avatar')) {
                $avatar = $request->avatar;
    
                $avatar_name    = time() . '.' . $avatar->getClientOriginalName();
                $imageoptimze   = new ImageOptimizer;
                $imageoptimze->upload_image($request->avatar, 'public/avatars/'.$avatar_name, false, '300', '300');
    
                $userDetails->avatar = $avatar_name;
                $userDetails->save();
            }
            $success = 'User has been updated.';
            return response()->json(
                [
                    'success' => 1,
                    'message' => $success
                ]
            );
            
            return response()->json($success);

        }else{

            $rules = array(
                'name'      => 'required',
                'email'     => 'required|email|unique:users',
                'password'  => 'required',
            );
    
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ];
            $validator = Validator::make($data,$rules);
         
            if($validator->fails()){
                return  response()->json(['errors'=>$validator->errors()],422);
            }   
            
            $role = Role::where('name',$request->role)->first(); 
            $data = New User;
            $data->name        = $request->name;
            $data->email       = $request->email;
            $data->password    = bcrypt($request->password);
            $data->role        = $role->name;
            $data->email_verified_at   = Carbon::now();
            // $data->phone_verified_at   = Carbon::now();
            $data->save();

            $userDetails =  new UserDetails();
            $userDetails->user_id = $data->id;

            
            if ($request->hasfile('avatar')) {
                $avatar = $request->avatar;
    
                $avatar_name    = time() . '.' . $avatar->getClientOriginalName();
                $imageoptimze   = new ImageOptimizer;
                $imageoptimze->upload_image($request->avatar, 'public/avatars/'.$avatar_name, false, '300', '300');
    
                $userDetails->avatar = $avatar_name;
                $userDetails->save();
            }


            $data->attachRole($role);

            $success = 'User has been Created.';
            return response()->json(
                [
                    'success' => 1,
                    'message' => $success
                ]
            );
        }
        

    }

    // Delete Confirmation Page
    public function show($id){
        try {
            $user = User::findOrFail($id);

            $params = [
                'title' => 'Confirm Delete Record',
                'user' => $user,
            ];

            return view('admin.users.users_delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function edit(Request $request){

      $data = User::with('userDetails')->findOrFail($request->id);
      return response()->json($data);

    }

   
    // Update User Information to DB
    public function update(Request $request, $id){
        try {
            $user = User::findOrFail($id);

            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
            ]);

            $user->name = $request->input('name');
            $user->email = $request->input('email');

            $user->save();

            // Update role of the user
            $roles = $user->roles;

            foreach ($roles as $key => $value) {
                $user->detachRole($value);
            }

            $role = Role::find($request->input('role_id'));

            $user->attachRole($role);

            // Update permission of the user
            //$permission = Permission::find($request->input('permission_id'));
            //$user->attachPermission($permission);

            return redirect()->route('users.index')->with('success', "The user <strong>$user->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Remove User from DB with detaching Role
    public function destroy(Request $request){
        $id = $request->id;
        try {
            $user = User::findOrFail($id);
            // Detach from Role
            $roles = $user->roles;
            foreach ($roles as $key => $value) {
                $user->detachRole($value);
            }

            $user->delete();
            
            UserDetails::where('user_id',$id)->delete();

            $success = "The user <strong>$user->name</strong> has successfully been Deleted.";
            return response()->json(
                [
                    'success' => 1,
                    'message' => $success
                ]
            );    
            
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }


    public function assignRroles(Request $request){
        // dd($request->all());
        $user = User::find($request->user_id);
        $user->attachRoles($request->roles);
    }


    public function getDetails(){
        $user    = User::with('userDetails')->find(auth()->user()->id); 
        $data = [
            'user_details'      => $user
        ];
        return AppHelper::customResponse($data,1,'Record Found');
    }


    public function updateBasics( Request $request ){

        $this->validate($request, [
            'first_name' => 'bail|required|max:20',
            'last_name' => 'bail|required|max:20',
            // 'email' => 'bail|required',
            'mobile' => 'bail|required|max:15',
        ]);

        // $email = preg_replace('/\s+/', '', $request->email);
        $mobile_number = str_replace(' ', '', $request->mobile);   

        $user = User::find(auth()->user()->id);
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;

        $user->name = $request->first_name . ' ' . $request->last_name;

        $user->mobile = $mobile_number;
        // $user->email  = $email;

        // event(new Registered(auth()->user()));

        $user->save();

        return AppHelper::customResponse($user,1,'Profile Updated');

    }

    public function changepassword(Request $request){
        
        $this->validate($request, [
            'old_password' => 'bail|required',
            'password' => 'bail|required|confirmed|min:6'
        ]);

        $user = User::find(auth()->user()->id); 

        //Check The Current Password Matched
        if (!Hash::check($request->get('old_password'), $user->password)){
            return AppHelper::customResponse([],1,'Old Password Is not Correct',422);
        }
               
        $user->password     = Hash::make($request->get('password'));
        $user->save();
        return AppHelper::customResponse([],1,'Your Password has been changed.');
    
    }


    public function getUserInformations(){

        $user = User::with('userDetails')->find(auth()->user()->id);
        $extraData = [
            'notifications'=>auth()->user()->load('notifications'),
        ];
        
        return AppHelper::customResponse(
            $user,
            1,
            'User Informations.',
            200,
            $extraData
        );
    }

    public function notifications(){
        $notifications = auth()->user()->unreadNotifications;
        return AppHelper::customResponse($notifications,1,'All Notifications');

    }
}
