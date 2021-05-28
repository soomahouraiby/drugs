<?php

namespace App\Http\Controllers\Api;

use App\batch_numbers;
use App\combinations;
use App\commercial_drug;
use App\diseases_app_users;
use App\effective_material;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function get_list_dis(){
        $user  = auth('api')->user();
        $user_dis =  diseases_app_users::where('app_user_id',  $user->id);
        $list_user_dis = array();
        foreach($user_dis->get() as $dis_id){
            $list_user_dis[] = $dis_id->diseases_id;
        }
        return  $list_user_dis;
    }

    public function batchnumber($batchnumber){

        $validator = Validator::make(
            [  'batchnumber' => $batchnumber ],
            ['batchnumber' => 'required|min:3|numeric' ]
        );



        if($validator->fails()){
            return response()->json(['error'=> true,
              'message' => $validator->errors() ], 401);
        }
       $data_drugs = batch_numbers::where('batch_num', $batchnumber)->first();
       if(empty($data_drugs)){
        return response()->json(['error'=> true,
        'message' => 'لم يتم العثور على اي نتيجة' ], 401);
       }
       $data_drugs->shipments;
       $data_drugs->commercial_drugs->combinations;

       $data_drugs->commercial_drugs->companies;
       $data_drugs->commercial_drugs->Agents;
       $data_drugs->commercial_drugs->diseases;
       $data_drugs->harmful = false;
       foreach($data_drugs->commercial_drugs->diseases as $drug_dis){
        $data_drugs->harmful = in_array($drug_dis->id, $this->get_list_dis())? true : false;
        if($data_drugs->harmful){
            break;
        }

    }
        return $data_drugs;
    }

    public function barcode( $barcode){



       ;
        $validator = Validator::make(
            [  'barcode' => $barcode ],
            ['barcode' => 'required|min:3|numeric' ]
        );


        if($validator->fails()){
            return response()->json(['error'=> true,
              'message' => $validator->errors() ], 401);
        }
       $data_drugs = batch_numbers::where('barcode',  $barcode)->first();


       if(empty($data_drugs)){
        return response()->json(['error'=> true,
        'message' => 'لم يتم العثور على اي نتيجة' ], 401);
       }
       $data_drugs->shipments;
       $data_drugs->commercial_drugs->combinations;

       $data_drugs->commercial_drugs->companies;
       $data_drugs->commercial_drugs->Agents;
       $data_drugs->commercial_drugs->diseases;
       $data_drugs->harmful = false;
       foreach($data_drugs->commercial_drugs->diseases as $drug_dis){
           $data_drugs->harmful = in_array($drug_dis->id, $this->get_list_dis())? true : false;
           if($data_drugs->harmful){
               break;
           }

       }
        return $data_drugs;
    }


    public function tradename( $tradename){

        $validator = Validator::make(['tradename'=> $tradename], [
            'tradename' => 'required|string|max:255'
        ]);


        if($validator->fails()){
            return response()->json(['error'=> true,
              'message' => $validator->errors() ], 401);
        }
       $data_drugs = commercial_drug::where('name', 'like' ,"%".  $tradename ."%");

       if(($data_drugs->count() == 0)){
        return response()->json(['error'=> true,
        'message' => 'لم يتم العثور على اي نتيجة' ], 401);
       }

       $reservations = $data_drugs->get();
       foreach ($reservations as $res){
        $res->companies;
        $res->Agents;
        $res->batch_numbers;
         $res->combinations;
        $res->diseases;
        $res->harmful = false;
        foreach($res->diseases as $drug_dis){
            $res->harmful = in_array($drug_dis->id, $this->get_list_dis())? true : false;
            if($res->harmful){
                break;
            }

        }
        //
        foreach($res->batch_numbers as $ba){
            $ba->shipments;
        }

       }


    if(( $data_drugs->count() == 0)){
        return response()->json(['error'=> true,
        'message' => 'لم يتم العثور على اي نتيجة' ], 401);
       }
        return   $reservations;
    }


    public function scientificname( $scientificname){
        $validator = Validator::make(['scientificname'=> $scientificname], [
            'scientificname' => 'required|string|max:255'
        ]);


        if($validator->fails()){
            return response()->json(['error'=> true,
              'message' => $validator->errors() ], 401);
        }
       $data_drugs = effective_material::where('name', 'like' ,"%". $scientificname ."%");

       if(($data_drugs->count() == 0)){
        return response()->json(['error'=> true,
        'message' => 'لم يتم العثور على اي نتيجة' ], 401);
       }

       $reservations = $data_drugs->get();
       foreach ($reservations as $res){

        $drugs =   combinations::where('material_id', $res->id);
        foreach($drugs->get() as $comm){
            $res->commercial_drug = $comm->commercial_drug;

            foreach($comm->commercial_drug as $drug){
                $drug->companies;
                $drug->Agents;
                $drug->batch_numbers;
                $drug->diseases;
                $drug->harmful = false;

                foreach($drug->diseases as $drug_dis){
                    $drug->harmful = in_array($drug_dis->id, $this->get_list_dis())? true : false;
                    if($drug->harmful){
                        break;
                    }

                }
                foreach($drug->batch_numbers as $ba){
                    $ba->shipments;
                }
            }


        }

       }


    if(( $data_drugs->count() == 0)){
        return response()->json(['error'=> true,
        'message' => 'لم يتم العثور على اي نتيجة' ], 401);
       }
        return   $reservations;
    }

    public function alternate( $alternate){



        $validator = Validator::make(['alternate'=> $alternate], [
            'alternate' => 'required|min:1|numeric'
        ]);


        if($validator->fails()){
            return response()->json(['error'=> true,
              'message' => $validator->errors() ], 401);
        }

        $data_drugs = combinations::where('commercial_id', $alternate );

        if(($data_drugs->count() == 0)){
         return response()->json(['error'=> true,
         'message' => 'لم يتم العثور على اي نتيجة' ], 401);
        }

        $reservations = $data_drugs->get();
        foreach ($reservations as $res){

             $res->commercial_drug ;

             foreach($res->commercial_drug as $drug){
                 $drug->companies;
                 $drug->Agents;
                 $drug->batch_numbers;
                 $drug->diseases;
                 $drug->harmful = false;
                 foreach($drug->diseases as $drug_dis){
                     $drug->harmful = in_array($drug_dis->id, $this->get_list_dis())? true : false;
                     if($drug->harmful){
                         break;
                     }

                 }
                 foreach($drug->batch_numbers as $ba){
                     $ba->shipments;
                 }
             }




        }


     if(( $data_drugs->count() == 0)){
         return response()->json(['error'=> true,
         'message' => 'لم يتم العثور على اي نتيجة' ], 401);
        }
         return   $reservations;
    }


}
