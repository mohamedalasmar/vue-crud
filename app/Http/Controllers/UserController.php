<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //
    public function register(Request $request){


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

    }

    public function login()
    {
        $credentials = request(['name', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['status'=>'success','token'=>$token]);
        }

        return response()->json(['status' => 'error']);
    }

    public function logout(){
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);

    }

}
