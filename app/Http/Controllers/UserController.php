<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if (!is_null($user) && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('login')->accessToken;
            return response()->json([
                'response' => true,
                'token' => $token                
            ]);
        } else
            return response()->json([
                'response' => false,
                'message' => "Wrong data"
            ]);
    }

    public function user(Request $request)
    {
        if ( auth()->guard('api')->check() ) {
            return response()->json([
                'response' => true,
                'data' => auth()->guard('api')->user()
            ]);            
        } else {
            return response()->json([
                'response' => false,
                'message' => 'Token is invalid'
            ]);
        }        
    }

    public function new(Request $request){
        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = 1;
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->save();
        print_r($user);
    }

    public function logout(){
        $user = auth()->user();
        $user->tokens->each(function ($token, $key){
            $token->delete();
        });
        return response()->json([
            'response' => true
        ]);
    }
}
