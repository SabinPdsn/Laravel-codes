<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class AuthController extends Controller
{
    public function AdminLogin(Request $request){
        $credentials = $request->only('email','password');

      if(Auth::attempt($credentials)){
        $Authenticated_user = Auth::user();

        if($Authenticated_user && $Authenticated_user->type === 'admin'){
            $token = $Authenticated_user->createToken('admin_token')->plainTextToken;

            return response()->json([
                'message' => 'welcome admin',
                'token' => $token
            ]);
        }
        else{
            return response()->json(['unauthorized access'],403);
        }
    }
      return response()->json(['invalid credentials'],401);
    }

    public function index(){
        return response()-> json([
            'user_datas' => User::all()->load('book')
        ]);
    }
}
