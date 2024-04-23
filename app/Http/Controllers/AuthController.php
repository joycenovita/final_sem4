<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// validator
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('email', $request->email)->first();

        if($user){
            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status' => 1,
                    'message' => 'Login success',
                    'data' => [
                        'user' => $user,
                        'token' => $token
                    ]
                ]);
            }else{
                return response()->json([
                    'status' => 0,
                    'message' => 'Password is incorrect'
                ]);
            }
        }else{
            return response()->json([
                'status' => 0,
                'message' => 'Email not found'
            ]);
        }
    }
}
