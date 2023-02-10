<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){

        $validator=$request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
           if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
                // $request->session()->regenerate();
                $response=[
                    'success'=>true,
                    'data'=>$success,
                    'message'=>'User Login Successfull'
                ];
                return response()->json($response, 400);
           }else{
            $response=[
                'success'=>false,
                'message'=>'Unauthorized'
            ];
            return response()->json($response);
           }
    }

}
