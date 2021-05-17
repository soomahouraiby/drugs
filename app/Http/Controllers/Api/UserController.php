<?php

namespace App\Http\Controllers\Api;

use App\App_user;
use App\Diseases;
use App\diseases_app_users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function userinfo(){

        $user  = auth('api')->user();
        $user->diseases;
        return $user ;
    }


    public function diseases(){

        $user  = auth('api')->user();

        return  $user->diseases;
    }

    public function diseasesupdate(Request $request){

        $user  = auth('api')->user();

        $validator = Validator::make($request->all(), [
            "dis" => 'required',
            "dis.*" => 'required|boolean'
        ]);



        if($validator->fails()){
            return response()->json(['error'=> true,
              'message' => $validator->errors() ], 401);
        }

        if(is_array($request->input('dis') )){


            foreach($request->input('dis') as $dis_id => $dis_type){


                if(is_numeric($dis_id) && !empty(Diseases::where('id', $dis_id )->first())){

                    if($dis_type == 0){

                        diseases_app_users::where('diseases_id', $dis_id)->where('app_user_id',  $user->id)->delete();

                    }else {
                        if( empty( diseases_app_users::where('diseases_id', $dis_id)->where('app_user_id',   $user->id)->first())){
                            $add_dis = new  diseases_app_users();
                            $add_dis->app_user_id = auth('api')->user()->id;
                            $add_dis->diseases_id = $dis_id;
                            $add_dis->save();

                        }
                    }

                }else {
                    return response()->json(['error'=> true,
                'message' => 'يوجد خطأ غير متوقع' ], 401);
                }
            }
        }else {
            return response()->json(['error'=> true,
                    'message' => 'يوجد خطأ غير متوقع' ], 401);
        }
            return response()->json(['error'=> false,
            'message' => 'تم التحديث بنجاح' ], 200);
    }

    public function userupdate(Request $request){

        $user  =  App_user::where( 'id', auth('api')->user()->id)->first();
        $user->name = 'csdc';


        if(!empty($request->input('name'))){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:50'
            ]);


            if($validator->fails()){
                return response()->json(['error'=> true,
                  'message' => $validator->errors() ], 401);
            }
            $user->name  = $request->input('name');

        }

        if(!empty($request->input('email'))){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:255|unique:app_users,id,'.$user->id
            ]);
            if($validator->fails()){
                return response()->json(['error'=> true,
                  'message' => $validator->errors() ], 401);
            }
            $user->email = $request->input('email');

        }


        if(!empty($request->input('password'))){
            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:8|confirmed',
            ]);
            if($validator->fails()){
                return response()->json(['error'=> true,
                  'message' => $validator->errors() ], 401);
            }
            $user->password = bcrypt($request->input('password'));
        }



        if(!empty($request->input('phone'))){
            $validator = Validator::make($request->all(), [
                'phone' => 'required|min:6|numeric'
            ]);
            if($validator->fails()){
                return response()->json(['error'=> true,
                  'message' => $validator->errors() ], 401);
            }
            $user->phone  = $request->input('phone');
        }



        if(!empty($request->input('age'))){
            $validator = Validator::make($request->all(), [
                'age' => 'numeric'
            ]);
            if($validator->fails()){
                return response()->json(['error'=> true,
                  'message' => $validator->errors() ], 401);
            }
            $user->age = $request->input('age');
        }




        if(!empty($request->input('sex'))){
            $validator = Validator::make($request->all(), [
                'sex' => 'boolean'
            ]);
            if($validator->fails()){
                return response()->json(['error'=> true,
                  'message' => $validator->errors() ], 401);
            }
            $user->sex  = $request->input('sex');
        }

        if(!empty($request->input('address'))){
            $validator = Validator::make($request->all(), [
                'address' => 'string'
            ]);
            if($validator->fails()){
                return response()->json(['error'=> true,
                  'message' => $validator->errors() ], 401);
            }
            $user->address  = $request->input('address');
        }
        if(!empty($request->input('adjective'))){
            $validator = Validator::make($request->all(), [
                'adjective' => 'string'
            ]);
            if($validator->fails()){
                return response()->json(['error'=> true,
                  'message' => $validator->errors() ], 401);
            }
            $user->adjective  = $request->input('adjective');
        }
        // print_r($request->all());

        if(count(array_filter($request->all())) == count($request->all())) {
            if(   $user->save()){
                return response()->json(['error'=> false,
            'message' => 'تم تحديث ملفك الشخصي بنجاح' ], 200);
            }
        }



        return response()->json(['error'=> true,
        'message' => 'عذرا ، لم يتم تحديث ملف التعريف الخاص بك' ], 401);
    }

    public function logout(){
        auth('api')->logout();
        return response()->json(['error'=> false,
        'message' => 'تم تسجيل الخروج بنجاح' ], 200);
    }
}
