<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Register success',
            'data' => $user
        ]);        
    }    

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->where('password', $request->password)->first();
        if ($user) {
            $token = Str::random(40);
            $user->api_token = $token;
            $user->save();
            return response()->json([
            'success' => true,
            'message' => 'Login success',
            'data' => $user
        ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Login failed',
            'data' => null
        ]);
    }

    public function detail()
    {
        $user = Auth::user();
        return response()->json([
            'success' => true,
            'message' => 'Detail user',
            'data' => $user
        ]);
    }
}
