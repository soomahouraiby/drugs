<?php
namespace App\Http\Controllers\pharmacovigilanceManagement;

use App\Events\NewNotification;
use App\Http\Controllers\Controller;
use App\Models\Report_alert_drug;
use App\Models\Commercial_drug;
use App\Models\App_user;
use App\Models\Report;
use App\Models\Types_report;
use App\Request\ReportsRequest;
use App\Models\Shipment;
use App\Models\Combination;
use App\Models\Effective_material;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use PDF;

class PHCManageController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:مدير التيقظ الدوائي']);
    }

    //عشان عرض البلاغات الوارده
    public function newReports()
    {
        $reports = DB::table('report_alert_drugs')
            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
            ->select('report_alert_drugs.id as report_no','app_users.name'
                , 'report_alert_drugs.user_name','report_alert_drugs.date_report', 'types_reports.name as type_report')
            ->where('report_alert_drugs.state','=',0)
            ->where('types_reports.name','!=','مهرب')
            ->where('types_reports.name','!=','مسحوب')
            ->where('types_reports.name','!=','غير مطابق')
            ->where('types_reports.name','!=','مستثناء')
            ->get();
        //return response($reports);
        return view('pharmacovigilanceManagement.newReports', compact('reports'));
    }

    // عشان اللفلترة حق البلاغات الوارده للاعراض الجانبية
    public function newEffectReports()
    {
        $reports = DB::table('report_alert_drugs')
            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
            ->select('report_alert_drugs.id as report_no','app_users.name'
                , 'report_alert_drugs.user_name','report_alert_drugs.date_report', 'types_reports.name as type_report')
            ->where('report_alert_drugs.state','=',0)
            ->where('types_reports.name','=','اعراض جانبية')
            ->get();
        return view('pharmacovigilanceManagement.newReports', compact('reports'));
    }
//عشان اللفلترة حق البلاغات الوارده للجودة
    public function newQualityReports()
    {
        $reports = DB::table('report_alert_drugs')
            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
            ->select('report_alert_drugs.id as report_no','app_users.name'
                , 'report_alert_drugs.user_name','report_alert_drugs.date_report', 'types_reports.name as type_report')
            ->where('report_alert_drugs.state','=',0)
            ->where('types_reports.name','=','جودة')
            ->get();
        return view('pharmacovigilanceManagement.newReports', compact('reports'));
    }

//عشان تفاصيل كل البلاغات
    public function detailsReport($id){
        $reports = DB::table('report_alert_drugs')->select('report_alert_drugs.id')
            ->where('report_alert_drugs.id','=', $id)->get();  // search in given table id only
        if (!$reports)
            return redirect()->back();
        $report = DB::table('report_alert_drugs')
            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
            ->select('report_alert_drugs.id as report_no','app_users.name'
                ,'app_users.email','app_users.phone','report_alert_drugs.state'
                , 'report_alert_drugs.date_report', 'types_reports.name as type_report',
                'report_alert_drugs.user_name','report_alert_drugs.sex',
                'report_alert_drugs.age','report_alert_drugs.weight',
                'report_alert_drugs.length','report_alert_drugs.method_obtaining',
                'report_alert_drugs.start_using_date','report_alert_drugs.take_drug',
                'report_alert_drugs.purpose_use','report_alert_drugs.dosage',
                'report_alert_drugs.stopped_using_date','report_alert_drugs.describe_problem',
                'report_alert_drugs.stopped_using','report_alert_drugs.facility_name',
                'report_alert_drugs.facility_address','report_alert_drugs.relative_relation')
            ->where('report_alert_drugs.id','=', $id)->get();
        if (isset($report) && $report->count() > 0) {
            foreach ($report as $reports) {

                $reports->sex = $reports->sex == 1 ? 'انثى' : 'ذكر';
                $reports->stopped_using = $reports->stopped_using == 1 ? 'نعم' : 'لا';
            }
        }


        $r = DB::table('report_alert_drugs')->select('report_alert_drugs.batch_number')
            ->where('report_alert_drugs.id', '=', $id)->get();
        foreach ($r as $rr) {
            $drug = DB::table('batch_numbers')
                ->join('commercial_drugs', 'batch_numbers.commercial_id', '=', 'commercial_drugs.id')
                ->join('combinations', 'combinations.commercial_id', '=','commercial_drugs.id')
                ->join('effective_materials', 'combinations.material_id', '=', 'effective_materials.id')
                ->join('companies', 'commercial_drugs.company_id', '=', 'companies.id')
                ->select('batch_numbers.batch_num', 'commercial_drugs.name as drug_name',
                    'commercial_drugs.drug_form','commercial_drugs.id as drug_no',
                    'effective_materials.name as material_name', 'companies.name as company_name')
                ->where('batch_numbers.batch_num','=', $rr->batch_number)->get();
        }

        $o_drug=DB::table('other_drugs')
            ->join('side_effects', 'other_drugs.side_effect_id', '=', 'side_effects.id')
            ->select('side_effects.id','side_effects.start_side_effect','side_effects.severity',
                'side_effects.patient_condition','side_effects.sideshow_still',
                'side_effects.date_end_side','side_effects.inform_doctor'
                ,'side_effects.doctor_name','side_effects.doctor_hospital'
                ,'side_effects.doctor_phone','other_drugs.side_effect_id',
                'other_drugs.name','other_drugs.dosage','other_drugs.start_use_date',
                'other_drugs.end_use_date','other_drugs.purpose_use')
            ->where('side_effects.report_alert_drug_id','=', $id)
            ->get();
        if (isset($o_drug) && $o_drug->count() > 0) {
            foreach ($o_drug as $o_drugs) {

                $o_drugs->sideshow_still = $o_drugs->sideshow_still == 1 ? 'نعم' : 'لا';
                $o_drugs->inform_doctor = $o_drugs->inform_doctor == 1 ? 'نعم' : 'لا';
            }
        }


        return view('pharmacovigilanceManagement.detailsReport', compact('report','drug','o_drug'));
        //return Response($drug);
    }

    public function transferReports($id,Request $request)
    {
        $reports = DB::table('report_alert_drugs')
            ->where('report_alert_drugs.id', '=', $id)
            ->update(['state'=>1]);

        return redirect()->back()->with(['success' => 'تم التحويل بنجاح ']);
    }

//عشان تفاصيل الدواء
    public function detailsDrug($id){

        $r = DB::table('batch_numbers')
            ->join('commercial_drugs', 'batch_numbers.commercial_id', '=', 'commercial_drugs.id')
            ->join('combinations', 'combinations.commercial_id', '=','commercial_drugs.id')
            ->join('effective_materials', 'combinations.material_id', '=', 'effective_materials.id')
            ->join('agents', 'commercial_drugs.agent_id', '=', 'agents.id')
            ->join('companies', 'commercial_drugs.company_id', '=', 'companies.id')
            ->select('batch_numbers.batch_num', 'commercial_drugs.name as drug_name',
                'commercial_drugs.id as drug_no','commercial_drugs.how_use'
                ,'commercial_drugs.side_effects', 'commercial_drugs.drug_form'
                ,'effective_materials.name as material_name','batch_numbers.production_date',
                'batch_numbers.expiry_date','agents.name as agent_name',
                'companies.name as company_name','companies.country')
            ->where('commercial_drugs.id','=',$id)->get();

        return view('pharmacovigilanceManagement.detailsDrug',compact('r'));
        //return response($r) ;

    }

// عشان عرض المتابعة للبلاغات
    public function followReports(){
        $reports = DB::table('report_alert_drugs')
            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
            ->select('report_alert_drugs.id as report_no','app_users.name'
                , 'report_alert_drugs.state','report_alert_drugs.user_name',
                'report_alert_drugs.date_report', 'types_reports.name as type_report')
            ->where('report_alert_drugs.state','!=',0)
            ->where('types_reports.name','!=','مهرب')
            ->where('types_reports.name','!=','مسحوب')
            ->where('types_reports.name','!=','غير مطابق')
            ->where('types_reports.name','!=','مستثناء')
            ->get();
        if (isset($reports) && $reports->count() > 0) {
            foreach ($reports as $report) {

                $report->state = $report->state == 2 ? ' تم الانهاء' : 'قيد المتابعة';
            }
        }

        return view('pharmacovigilanceManagement.followReports',compact('reports'));
    }
    //عشان اللفلترة حق قيد المتابعة
    public function followingReports(){
        $reports = DB::table('report_alert_drugs')
            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
            ->select('report_alert_drugs.id as report_no','app_users.name'
                , 'report_alert_drugs.state','report_alert_drugs.date_report',
                'report_alert_drugs.user_name', 'types_reports.name as type_report')
            ->where('report_alert_drugs.state','=',1)
            ->where('types_reports.name','!=','مهرب')
            ->where('types_reports.name','!=','مسحوب')
            ->where('types_reports.name','!=','غير مطابق')
            ->where('types_reports.name','!=','مستثناء')
            ->get();
        if (isset($reports) && $reports->count() > 0) {
            foreach ($reports as $report) {

                $report->state = $report->state == 2 ? ' تم الانهاء' : 'قيد المتابعة';
            }
        }
        return view('pharmacovigilanceManagement.followReports',compact('reports'));
    }
    //عشان اللفلترة حق تم الانهاء
    public function doneReports(){
        $reports = DB::table('report_alert_drugs')
            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
            ->select('report_alert_drugs.id as report_no','app_users.name'
                , 'report_alert_drugs.state','report_alert_drugs.date_report',
                'report_alert_drugs.user_name','types_reports.name as type_report')
            ->where('report_alert_drugs.state','=',2)
            ->where('types_reports.name','!=','مهرب')
            ->where('types_reports.name','!=','مسحوب')
            ->where('types_reports.name','!=','غير مطابق')
            ->where('types_reports.name','!=','مستثناء')
            ->get();
        if (isset($reports) && $reports->count() > 0) {
            foreach ($reports as $report) {

                $report->state = $report->state == 2 ? ' تم الانهاء' : 'قيد المتابعة';
            }
        }
        return view('pharmacovigilanceManagement.followReports',compact('reports'));
    }


//عشان تفاصيل المتابعة
    public function followedUp($id){
        $reports = DB::table('report_alert_drugs')->select('report_alert_drugs.id')
            ->where('report_alert_drugs.id','=', $id)->get();  // search in given table id only
        if (!$reports)
            return redirect()->back();
        $report = DB::table('report_alert_drugs')
            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
            ->select('report_alert_drugs.id as report_no','app_users.name'
                ,'app_users.phone', 'report_alert_drugs.date_report', 'types_reports.name as type_report',
                'report_alert_drugs.facility_name','report_alert_drugs.state','report_alert_drugs.notes')
            ->where('report_alert_drugs.id','=', $id)->get();

        $r = DB::table('report_alert_drugs')->select('report_alert_drugs.batch_number')
            ->where('report_alert_drugs.id', '=', $id)->get();
        foreach ($r as $rr) {
            $drug = DB::table('batch_numbers')
                ->join('commercial_drugs', 'batch_numbers.commercial_id', '=', 'commercial_drugs.id')
                ->select( 'commercial_drugs.name as drug_name', 'commercial_drugs.id as drug_no')
                ->where('batch_numbers.batch_num','=', $rr->batch_number)->get();
        }


        return view('pharmacovigilanceManagement.followedUp',compact('report','drug'));
    }

//عشان اضافة اجراء على البلاغ
    public function store($id,Request $request)
    {
        DB::table('report_alert_drugs')->select('report_alert_drugs.id as report_no')
            ->where('report_alert_drugs.id', '=', $id)
            ->update(['notes' => $request->notes,
                'state'=>2 ]);
        return redirect()->route('PHC_followedUp',$id);



    }



    //عشان عرض البلاغات للتقارير
    public function Reports()
    {
        $reports = DB::table('report_alert_drugs')
            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
            ->select('report_alert_drugs.id as report_no','app_users.name'
                , 'report_alert_drugs.user_name','report_alert_drugs.date_report', 'types_reports.name as type_report')
            //->where('report_alert_drugs.state','=',0)
            ->where('types_reports.name','!=','مهرب')
            ->where('types_reports.name','!=','مسحوب')
            ->where('types_reports.name','!=','غير مطابق')
            ->where('types_reports.name','!=','مستثناء')
            ->get();
        //return response($reports);
        return view('pharmacovigilanceManagement.Reports', compact('reports'));
    }

     //   للتقاريرعشان اللفلترة حق البلاغات الوارده للاعراض الجانبية
    public function EffectReports()
    {
        $reports = DB::table('report_alert_drugs')
            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
            ->select('report_alert_drugs.id as report_no','app_users.name'
                , 'report_alert_drugs.user_name','report_alert_drugs.date_report', 'types_reports.name as type_report')
            //->where('report_alert_drugs.state','=',0)
            ->where('types_reports.name','=','اعراض جانبية')
            ->get();
        return view('pharmacovigilanceManagement.Reports', compact('reports'));
    }
// للتقاريرعشان اللفلترة حق البلاغات الوارده للجودة
    public function QualityReports()
    {
        $reports = DB::table('report_alert_drugs')
            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
            ->select('report_alert_drugs.id as report_no','app_users.name'
                , 'report_alert_drugs.user_name','report_alert_drugs.date_report', 'types_reports.name as type_report')
            //->where('report_alert_drugs.state','=',0)
            ->where('types_reports.name','=','جودة')
            ->get();
        return view('pharmacovigilanceManagement.Reports', compact('reports'));
    }
//    public function pdf(){
//        $reports = DB::table('report_alert_drugs')
//            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
//            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
//            ->select('report_alert_drugs.id as report_no','app_users.name'
//                , 'report_alert_drugs.user_name','report_alert_drugs.date_report', 'types_reports.name as type_report')
//            //->where('report_alert_drugs.state','=',0)
//            ->where('types_reports.name','=','جودة')
//            ->get();
//
//        foreach($reports as $report) {
//            $data ['report_no'] = $report->report_no;
//            $data ['name'] = $report->name;
//            $data ['user_name'] = $report->user_name;
//            $data ['date_report'] = $report->date_report;
//            $data ['type_report'] = $report->type_report;
//        }
//
//
//        $pdf = PDF::loadView('pharmacovigilanceManagement.pdf', $data);
//        return $pdf->stream('document.pdf');
//
//        //return view('pharmacovigilanceManagement.pdf' ,compact('reports'));
//    }

    public function pdf($id){
        $reports = DB::table('report_alert_drugs')->select('report_alert_drugs.id')
            ->where('report_alert_drugs.id','=', $id)->get();  // search in given table id only
        if (!$reports)
            return redirect()->back();
        $reports = DB::table('report_alert_drugs')
            ->join('types_reports', 'report_alert_drugs.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'report_alert_drugs.app_user_id', '=', 'app_users.id')
            ->select('report_alert_drugs.id as report_no','app_users.name'
                ,'app_users.email','app_users.phone','report_alert_drugs.state'
                , 'report_alert_drugs.date_report', 'types_reports.name as type_report',
                'report_alert_drugs.user_name','report_alert_drugs.sex',
                'report_alert_drugs.age','report_alert_drugs.weight',
                'report_alert_drugs.length','report_alert_drugs.method_obtaining',
                'report_alert_drugs.start_using_date','report_alert_drugs.take_drug',
                'report_alert_drugs.purpose_use','report_alert_drugs.dosage',
                'report_alert_drugs.stopped_using_date','report_alert_drugs.describe_problem',
                'report_alert_drugs.stopped_using','report_alert_drugs.facility_name',
                'report_alert_drugs.facility_address','report_alert_drugs.relative_relation')
            ->where('report_alert_drugs.id','=', $id)->get();
        if (isset($reports) && $reports->count() > 0) {
            foreach ($reports as $report) {

                $report->sex = $report->sex == 1 ? 'انثى' : 'ذكر';
                $report->stopped_using = $report->stopped_using == 1 ? 'نعم' : 'لا';
            }
        }


        $r = DB::table('report_alert_drugs')->select('report_alert_drugs.batch_number')
            ->where('report_alert_drugs.id', '=', $id)->get();
        foreach ($r as $rr) {
            $drug = DB::table('batch_numbers')
                ->join('commercial_drugs', 'batch_numbers.commercial_id', '=', 'commercial_drugs.id')
                ->join('combinations', 'combinations.commercial_id', '=','commercial_drugs.id')
                ->join('effective_materials', 'combinations.material_id', '=', 'effective_materials.id')
                ->join('companies', 'commercial_drugs.company_id', '=', 'companies.id')
                ->select('batch_numbers.batch_num', 'commercial_drugs.name as drug_name',
                    'commercial_drugs.drug_form','commercial_drugs.id as drug_no',
                    'effective_materials.name as material_name', 'companies.name as company_name')
                ->where('batch_numbers.batch_num','=', $rr->batch_number)->get();
        }

        $o_drug=DB::table('other_drugs')
            ->join('side_effects', 'other_drugs.side_effect_id', '=', 'side_effects.id')
            ->select('side_effects.id','side_effects.start_side_effect','side_effects.severity',
                'side_effects.patient_condition','side_effects.sideshow_still',
                'side_effects.date_end_side','side_effects.inform_doctor'
                ,'side_effects.doctor_name','side_effects.doctor_hospital'
                ,'side_effects.doctor_phone','other_drugs.side_effect_id',
                'other_drugs.name','other_drugs.dosage','other_drugs.start_use_date',
                'other_drugs.end_use_date','other_drugs.purpose_use')
            ->where('side_effects.report_alert_drug_id','=', $id)
            ->get();
        if (isset($o_drug) && $o_drug->count() > 0) {
            foreach ($o_drug as $o_drugs) {

                $o_drugs->sideshow_still = $o_drugs->sideshow_still == 1 ? 'نعم' : 'لا';
                $o_drugs->inform_doctor = $o_drugs->inform_doctor == 1 ? 'نعم' : 'لا';
            }
        }


        foreach($reports as $report) {
            $data ['report_no'] = $report->report_no;
            $data ['name'] = $report->name;
            $data ['user_name'] = $report->user_name;
            $data ['date_report'] = $report->date_report;
            $data ['type_report'] = $report->type_report;
            $data ['email'] = $report->email;
            $data ['state'] = $report->state;
            $data ['phone'] = $report->phone;
            $data ['weight'] = $report->weight;
            $data ['age'] = $report->age;
            $data ['sex'] = $report->sex;
            $data ['take_drug'] = $report->take_drug;
            $data ['method_obtaining'] = $report->method_obtaining;
            $data ['start_using_date'] = $report->start_using_date;
            $data ['length'] = $report->length;
            $data ['describe_problem'] = $report->describe_problem;
            $data ['stopped_using_date'] = $report->stopped_using_date;
            $data ['dosage'] = $report->dosage;
            $data ['purpose_use'] = $report->purpose_use;
            $data ['relative_relation'] = $report->relative_relation;
            $data ['facility_address'] = $report->facility_address;
            $data ['facility_name'] = $report->facility_name;
            $data ['stopped_using'] = $report->stopped_using;
        }
        foreach($drug as $drugs) {
            $data ['drug_no'] = $drugs->drug_no;
            $data ['drug_form'] = $drugs->drug_form;
            $data ['drug_name'] = $drugs->drug_name;
            $data ['batch_num'] = $drugs->batch_num;
            $data ['company_name'] = $drugs->company_name;
            $data ['material_name'] = $drugs->material_name;
        }
        foreach($o_drug as $o_drugs) {
            $data ['id'] = $o_drugs->id;
            $data ['start_side_effect'] = $o_drugs->start_side_effect;
            $data ['severity'] = $o_drugs->severity;
            $data ['inform_doctor'] = $o_drugs->inform_doctor;
            $data ['date_end_side'] = $o_drugs->date_end_side;
            $data ['sideshow_still'] = $o_drugs->sideshow_still;
            $data ['patient_condition'] = $o_drugs->patient_condition;
            $data ['doctor_name'] = $o_drugs->doctor_name;
            $data ['doctor_hospital'] = $o_drugs->doctor_hospital;
            $data ['doctor_phone'] = $o_drugs->doctor_phone;
            $data ['purpose_use'] = $o_drugs->purpose_use;
            $data ['end_use_date'] = $o_drugs->end_use_date;
            $data ['start_use_date'] = $o_drugs->start_use_date;
            $data ['dosage'] = $o_drugs->dosage;
            $data ['name'] = $o_drugs->name;
        }


        $pdf = PDF::loadView('pharmacovigilanceManagement.pdf', $data);
        return $pdf->stream('document.pdf');
    }
}
