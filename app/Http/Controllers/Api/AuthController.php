<?php

namespace App\Http\Controllers\Api;

use App\App_user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email',
            'password' => 'required|min:8',
        ]);


        if($validator->fails()){
            return response()->json(['error'=> true,
              'message' => $validator->errors() ], 401);
        }

        $credintials = request(['email', 'password']);

        $token = auth('api')->attempt($credintials);

        if(!$token){
            return response()->json(['error'=> true,
              'message' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة ' ], 405);
        }

        return response()->json(['error'=> false,
        'access_token'=> $token,
        'exprire_in'=> auth('api')->factory()->getTTL() * 3600,
        'Authorization' => 'Bearer '.$token,
        'message' => 'تم تسجيل الدخول' ], 200);

    }


    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:app_users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|min:11|numeric',
            'age' => 'numeric',
            'sex' => 'boolean',
        ]);


        if($validator->fails()){
            return response()->json(['error'=> true,
              'message' => $validator->errors() ], 401);
        }

        $App_user = new App_user;
        $App_user->name = $request->input('name');
        $App_user->email = $request->input('email');
        $App_user->phone = $request->input('phone');
        $App_user->age = $request->input('age');
        $App_user->sex = $request->input('sex');
        $App_user->password = bcrypt($request->input('password'));
        $App_user->save();

        $credintials = request(['email', 'password']);

        $token = auth('api')->attempt($credintials);

        if(!$token){
            return response()->json(['error'=> true,
              'message' => 'غير مصرح' ], 405);
        }

        return response()->json(['error'=> false,
        'access_token'=> $token,
        'exprire_in'=> auth('api')->factory()->getTTL() * 3600,
        'Authorization' => 'Bearer '.$token,
        'message' => 'تم التسجيل  بنجاح' ], 200);
    }

}
