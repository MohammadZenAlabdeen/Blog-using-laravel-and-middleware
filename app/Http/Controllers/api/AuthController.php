<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Store a newly created resource in storage.
     */

        public function register(Request $request)
        {   
            
            $validated=$request->validate(
                [
                    'email'=>'required|email|unique:users',
                    'name'=>'required|string',
                    'password'=>'min:8|string|required',
                    'img'=>'image'
                ]
                );
            $user=new User();
            $user->name=$validated['name'];
            $user->email=$validated['email'];
            $user->Password = Hash::make($validated['password']);
            $image = $validated['img'];
            $imageName= time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$imageName);
            $user->img=$imageName;
            $user->save();
            $token= $user->createToken($validated['email'])->plainTextToken;
            $response=[
                'status' => 'success',
                'message' => 'user created successfully',
                'data' => [
                    'token' => $token,
                    'user' => $user,
                ],
            ];
            return response()->json($response,201);
        
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required| email',
            'password' =>'required'
        ]);
        $user=User::where('email',$credentials['email'])->first();
        if(!$user ||!Hash::check($credentials['password'],$user->password) ||$user->ban===1){
            return response()->json(
                [
                    'status'=>'failed',
                    'message' =>'banned or wrong info or does not exist',
                ],401
            );
        }
        $token= $user->createToken($credentials['email'])->plainTextToken;
        $response=[
            'status' => 'success',
            'message' => 'user logged in successfully',
            'data' => [
                'token' => $token,
                'user' => $user,
            ],
        ];
        return response()->json($response,201);
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' =>'success',
            'message' => 'user is logged out successfully'
        ],200);
    }

    /**
     * Display the specified resource.
     */

}
