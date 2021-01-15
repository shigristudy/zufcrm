<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get authenticated user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function current(Request $request)
    {
        return response()->json($request->user());
    }

    public function store(Request $request){
        $this->validate($request, [
            'email'     => 'required|unique:users',
            'name'      => 'required',
            'password'  => 'required',
            'role'      => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  bcrypt($request->password);
        $user->role = $request->role;
        $user->save();
        return response()->json([
            'user'     => $user,
            'success'  => 1,
            'message'  => 'User Created Successfull!',
        ]);
    }

    public function update(Request $request){

        $this->validate($request, [
            'name'      => 'required',
            'role'      => 'required',
        ]);
        $user = User::find($request->id);
        $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password =  bcrypt($request->password);
        $user->role     = $request->role;
        $user->save();
        return response()->json([
            'user'     => $user,
            'success'  => 1,
            'message'  => 'User Updated Successfull!',
        ]);
    }

    public function edit( Request $request ){
        $user = User::find($request->id);
        return response()->json([
            'user'     => $user,
            'success'  => 1,
            'message'  => 'User Informations!',
        ]);
    }

    public function destroy(Request $request){
    
        $role = User::findOrFail($request->id);

        $role->forceDelete();
        $success = 'User has been deleted.';
        return response()->json([
            'success' => 1,
            'message' => $success  
        ]);
    }
}
