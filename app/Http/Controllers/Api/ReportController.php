<?php

namespace App\Http\Controllers\Api;

use App\batch_numbers;
use App\Http\Controllers\Controller;
use App\other_drugs;
use App\report_alert_drugs;
use App\reports;
use App\side_effects;
use App\types_reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ReportController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function get_basename($filename) {// https://stackoverflow.com/questions/29122208/php-preg-replace-string-path-given
        return preg_replace('/^.+[\\\\\\/]/', '', $filename);
    }

    public function index(Request $request, $type){

        $user  = auth('api')->user();
        $validator = Validator::make(['type' => $type], [
            'type' => 'required|exists:types_reports,name',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ], 401);
        }
        if ($type != 'quality' || $type != 'side_effects') {

            $batchnumber = $request->input('batchnumber');
            $notes_user = $request->input('notesuser');
            $district = $request->input('district');
            $commercial_name = $request->input('commercialname');
            $drug_price = $request->input('drugprice');
            $company_name = $request->input('companiesname');
            $agent_name = $request->input('agentname');
            $material_name = $request->input('materialname');
            $pharmacy_title = $request->input('pharmacytitle');
            $street_name = $request->input('streetname');
            $neig_name = $request->input('neigname');
            $site_dec = $request->input('sitedec');
            $longitude = $request->input('longitude');
            $latitude = $request->input('latitude');

            $val_batchnumber = $type != 'smuggler' ? 'required|exists:batch_numbers,batch_num' : 'exists:batch_numbers,batch_num';

            $validator = Validator::make($request->all(), [
                'batchnumber' =>  $val_batchnumber,
                'drugpicture' => 'numeric',
                'longitude'    => 'numeric',
                'latitude'     => 'numeric'
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()
                ], 401);
            }


            $report = new  reports();
            $report->app_user_id =   $user->id;
            $report->types_report_id = types_reports::where('name', $type)->first()->id;
            $report->batch_number = $batchnumber;
            $report->notes_user = $notes_user;
            $report->district = $district;

            $report->pharmacy_title = $pharmacy_title;
            $report->street_name = $street_name;
            $report->neig_name = $neig_name;
            $report->site_dec = $site_dec;
            $report->longitude = $longitude;
            $report->latitude = $latitude;
        }

        if ($type == 'drawn') {

            if ((empty($longitude) || empty($latitude))) {
                if ((empty($pharmacy_title) || empty($street_name) || empty($neig_name))) {
                    return response()->json([
                        'error' => true,
                        'message' => 'يجب عليك إرسال معلومات عن الصيدلية'
                    ], 401);
                }
            }

            if (batch_numbers::where('batch_num', $batchnumber)->where('drug_drawn', true)->count() == 0) {
                return response()->json([
                    'error' => true,
                    'message' => 'هذا الدواء غير مسحوب'
                ], 401);
            }

            $report->save();
            return response()->json([
                'error' => false,
                'message' => 'تم ارسال البلاغ الخاص بك بنجاح. شكرا لك'
            ], 401);
        }

        if ($type == 'exception') {
            if ((empty($longitude) || empty($latitude))) {
                if ((empty($pharmacy_title) || empty($street_name) || empty($neig_name))) {
                    return response()->json([
                        'error' => true,
                        'message' => 'يجب عليك إرسال معلومات عن الصيدلية'
                    ], 401);
                }
            }

            if (batch_numbers::where('batch_num', $batchnumber)->first()->shipments->expception == 1) {
                return response()->json([
                    'error' => true,
                    'message' => 'هذا الدواء ليس مستثنى'
                ], 401);
            }



            $report->save();
            return response()->json([
                'error' => false,
                'message' => 'تم ارسال البلاغ الخاص بك بنجاح. شكرا لك'
            ], 401);
        }



        if ($type == 'not_matching') {
            if ((empty($longitude) || empty($latitude))) {
                if ((empty($pharmacy_title) || empty($street_name) || empty($neig_name))) {
                    return response()->json([
                        'error' => true,
                        'message' => 'يجب عليك إرسال معلومات عن الصيدلية'
                    ], 401);
                }
            }

            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()
                ], 401);
            }
                $path = $request->file('image')->store('images/report', 'public');
                // print_r(asset('storage/'.$path ));
                $report->drug_photo = $this->get_basename( $path);


                $report->drug_price = $drug_price;
                $report->save();
            return response()->json([
                'error' => false,
                'message' => 'تم ارسال البلاغ الخاص بك بنجاح. شكرا لك'
            ], 401);
        }



        if ($type == 'smuggler') {
            if ((empty($longitude) || empty($latitude))) {
                if ((empty($pharmacy_title) || empty($street_name) || empty($neig_name))) {
                    return response()->json([
                        'error' => true,
                        'message' => 'يجب عليك إرسال معلومات عن الصيدلية'
                    ], 401);
                }
            }

            $validator = Validator::make($request->all(), [
                'commercialname' => 'required|string',
                'companiesname' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);


            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()
                ], 401);
            }

                $path = $request->file('image')->store('images/report', 'public');
                // print_r(asset('storage/'.$path ));
                $report->drug_photo = $this->get_basename( $path);

            $report->commercial_name = $commercial_name;
            $report->company_name = $company_name;
            $report->agent_name = $agent_name;
            $report->material_name = $material_name;
            $report->drug_price = $drug_price;
            $report->save();
            return response()->json([
                'error' => false,
                'message' => 'تم ارسال البلاغ الخاص بك بنجاح. شكرا لك'
            ], 401);
        }

        if ($type == 'quality' || $type == 'side_effects') {



            $validator = Validator::make($request->all(), [
                'username'        => 'string',
                'sex'             => 'required|boolean',
                'age'             => 'required|numeric',
                'weight'          => 'required|numeric',
                'length'          => 'required|numeric',
                'batchnumber'     => 'required|exists:batch_numbers,batch_num',
                'methodobtaining' => 'required',
                'facilityname' => 'required',
                'facilityaddress' => 'required',
                'startusingdate'  => 'required|date',
                'takedrug'        => 'required',
                'purposeuse'      => 'required',
                'dosage'          => 'required',
                'stoppedusingdate' => 'required|date',
                'stoppedusing'   => 'boolean',
                'describeproblem' => 'required',
                'relativerealtion'  => 'required',
                'notes'             => 'required'
            ]);



            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()
                ], 401);
            }

            $report_alert = new  report_alert_drugs();
            $report_alert->app_user_id =   $user->id;
            $report_alert->types_report_id = types_reports::where('name', $type)->first()->id;
            $report_alert->user_name =  $request->input('username');
            $report_alert->sex =  $request->input('sex');
            $report_alert->age =  $request->input('age');
            $report_alert->weight =  $request->input('weight');
            $report_alert->length =  $request->input('length');
            $report_alert->batch_number =  $request->input('batchnumber');
            $report_alert->method_obtaining =  $request->input('methodobtaining');
            $report_alert->facility_name =  $request->input('facilityname');
            $report_alert->start_using_date =  $request->input('startusingdate');
            $report_alert->take_drug =  $request->input('takedrug');
            $report_alert->purpose_use =  $request->input('purposeuse');
            $report_alert->dosage =  $request->input('dosage');
            $report_alert->stopped_using_date =  $request->input('stoppedusingdate');
            $report_alert->stopped_using =  $request->input('stoppedusing');
            $report_alert->describe_problem =  $request->input('describeproblem');
            $report_alert->facility_address = $request->input('facilityaddress');
            $report_alert->relative_realtion = $request->input('relativerealtion');
            $report_alert->notes = $request->input('notes');


            if ($type == 'side_effects') {

                $validator = Validator::make($request->all(), [
                    'startsideeffect'           => 'required|date',
                    'severity'                  => 'required',
                    'sideshowstill'             => 'required|boolean',
                    'dateendside'               => 'date',
                    'patientcondition'          => 'required',
                    'informdoctor'              => 'required|numeric',
                    'doctorname'                => 'required',
                    'doctorhospital'            => 'required',
                    'doctorphone'               => 'required|numeric',
                ]);


                if ($validator->fails()) {
                    return response()->json([
                        'error' => true,
                        'message' => $validator->errors()
                    ], 401);
                }
            }
            $report_alert->save();
            if ($type == 'side_effects') {
                $side_effect = new  side_effects();
                $side_effect->report_alert_drug_id  =   $report_alert->id;
                $side_effect->start_side_effect  =  $request->input('startsideeffect');
                $side_effect->severity  =  $request->input('severity');
                $side_effect->sideshow_still  =  $request->input('sideshowstill');
                $side_effect->date_end_side  =  $request->input('dateendside');
                $side_effect->patient_condition  =  $request->input('patientcondition');
                $side_effect->inform_doctor  =  $request->input('informdoctor');
                $side_effect->doctor_name  =  $request->input('doctorname');
                $side_effect->doctor_hospital  =  $request->input('doctorhospital');
                $side_effect->doctor_phone  =  $request->input('doctorphone');


                $validator = Validator::make($request->all(), [
                    'otherdrugs.*.name'        => 'required',
                    'otherdrugs.*.dosage'        => 'required',
                    'otherdrugs.*.dtartusedate'        => 'required|date',
                    'otherdrugs.*.endusedate'        => 'required|date',
                    'otherdrugs.*.purposeuse'        => 'required',

                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'error' => true,
                        'message' => $validator->errors()
                    ], 401);
                }
                $side_effect->save();

                if(is_array($request->input('otherdrugs'))){

                        foreach($request->input('otherdrugs') as $atherdu){
                            $other_drugs =   new  other_drugs();
                            $other_drugs->name =  $atherdu['name'];
                            $other_drugs->dosage =  $atherdu['dosage'];
                            $other_drugs->dtart_use_date =  $atherdu['dtartusedate'];
                            $other_drugs->end_use_date =  $atherdu['endusedate'];
                            $other_drugs->purpose_use =  $atherdu['purposeuse'];
                            $other_drugs->side_effect_id  =  $side_effect->id;
                            $other_drugs->save();
                        }
                }


            }
            return response()->json([
                'error' => false,
                'message' => 'تم ارسال البلاغ الخاص بك بنجاح. شكرا لك'
            ], 401);
        }
    }
}
