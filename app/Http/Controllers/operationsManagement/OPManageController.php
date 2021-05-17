<?php
namespace App\Http\Controllers\operationsManagement;

use App\Events\NewNotification;
use App\Http\Controllers\Controller;
use App\Models\Batch_number;
use App\Models\Report;
use App\Models\Commercial_drug;
use App\Models\App_user;
use App\Models\Type_report;
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

class OPManageController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:مدير العمليات']);
    }


    //////////////// [ Show .. بلاغات وارده ]  ////////////////
    public function newReports()
    {
        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->select('reports.id','app_users.name as name_user'
                , 'reports.date', 'types_reports.name as type_report')

            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('state','=',0)
            ->where('types_reports.name','!=','جودة')
            ->get();

        return view('operationsManagement.newReports', compact('reports'));

    }

    //////////////// [ Show .. متابعة البلاغات الوارده ]  ////////////////
    public function followReports(){

        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id','reports.state','app_users.name as name_user',
                'reports.date', 'reports.transfer_date','reports.transfer_party','reports.transfer_party',
                'reports.report_statuses' , 'types_reports.name as type_report','reports.opmanage_notes')

            ->where('report_statuses','!=',null)
            ->where('transfer_party','!=',null)
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();

//        $reports2 = DB::table('reports')
//            ->join('types_reports', 'reports.type_report_no', '=', 'types_reports.type_report_no')
//            ->select('reports.report_no','reports.authors_name',
//                'reports.report_date', 'reports.transfer_date','reports.transfer_party',
//                'reports.report_statues' , 'types_reports.type_report')
//            ->where('app_user_no','=',null)
//            ->where('report_statues','!=',null)
//            ->where('transfer_party','!=',null)
//            ->where('type_report','!=','اعراض جانبية')
//            ->where('type_report','!=','جودة')
//            ->get();
        return view('operationsManagement/followReports',compact('reports'));
    }




    //////////////// [ Transfer .. تحويل البلاغ الوارد ]  ////////////////
    public function transferReports($report_no,Request $request)
    {
        $reports = DB::table('reports')->select('reports.transfer_party')
            ->where('reports.id', '=', $report_no)

            ->update(['transfer_party' => 'ادارة الصيدلة',
                'transfer_date' => Carbon::now()->toDateTimeString()
                ,'state'=>1,'reports.report_statuses'=>'محول للمتابعة']);

        $data =[
            'id' => 'aa',
            'state' =>'g' ,
        ];
        event(new NewNotification($data));
        return redirect()->back();
    }

    //////////////// [Save .. لحفظ ملاحظة المدير ]  ////////////////
    public function saveOPMNotes($report_no,Request $request)
    {
        Report::select('reports.id')
            ->where('reports.id', '=', $report_no)
            ->update(['opmanage_notes' => $request->opmanage_notes,
                'reports.report_statuses'=>'تم الانهاء' ]);


        return redirect()->route('OP_followedUp',$report_no);
    }

    //////////////// [ Add report .. إضافة بلاغ ]  ////////////////
    public function addReport(){
        return view('operationsManagement/addReport');
    }
    public function selectBNumber(Request $request){
        $batch_no = $request->input('batch_num');
        $drug=DB::table('batch_numbers')
            ->join('commercial_drugs', 'batch_numbers.commercial_id', '=', 'commercial_drugs.id')
            ->select('commercial_drugs.name','commercial_drugs.id as drug_no','batch_numbers.drug_drawn')
            ->where('batch_num','=', $batch_no)->get();

        return view('operationsManagement/addReport',compact('drug'));
    }
    public function store(Request  $request): \Illuminate\Http\RedirectResponse
    {
        $reports = DB::table('reports')->insert([
            'amount_name' =>   $request->input('amount_name'),
            'phone' =>  $request->input('phone'),
            'adjective' => $request->input('adjective'),
            'age' => $request->input('age'),
            'sex'=> $request->input('sex'),
            'date'=>Carbon::now()->toDateTimeString(),
            'transfer_party' =>'ادارة الصيدلة',
            'transfer_date'=>Carbon::now()->toDateTimeString(),
            'commercial_name' =>   $request->input('commercial_name'),
            'material_name' =>  $request->input('material_name'),
            'company_name' => $request->input('company_name'),
            'agent_name' => $request->input('agent_name'),
            'batch_number' => $request->input('batch_num'),
            'drug_price' => $request->input('drug_price'),
            'district' => $request->input('district'),
            'notes_user' =>$request->input('notes_user'),
            'state'=>1,
            'types_report_id' =>$request->input('types_report_id'),
            'pharmacy_title' => $request->input('pharmacy_title'),
            'street_name' => $request->input('street_name'),
            'neig_name' => $request->input('neig_name'),
            'site_dec' => $request->input('site_dec'),
            'source'=>'1',
            'report_statuses'=>'محول للمتابعة'
        ]);
        return redirect()->back()->with(['success' => 'تم اضافه البلاغ بنجاح ']);
    }





    //////////////// [ Details ..  بلاغ وارد ]  ////////////////
    public function detailsReport($id){

        $report = DB::table('reports')->select('reports.id')
            ->where('id','=', $id)->get();
        if (!$report)
            return redirect()->back();

        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id','reports.state','reports.drug_picture','reports.notes_user', 'reports.date',
                'reports.drug_price','reports.commercial_name','reports.company_name','reports.agent_name',
                'reports.site_dec','reports.neig_name','reports.pharmacy_title','reports.street_name',
                'app_users.name as name_user', 'app_users.phone as phone_user', 'app_users.adjective'
                , 'app_users.age','app_users.report_count','reports.report_statuses',
                'types_reports.name as type_report')
            ->where('reports.id', '=', $id)->get();

        $batches = DB::table('reports')->select('reports.batch_number')
            ->where('reports.id', '=', $id)->get();

        foreach ($batches as $batch) {

            $drugs = DB::table('batch_numbers')
                ->join('commercial_drugs', 'batch_numbers.commercial_id', '=', 'commercial_drugs.id')
                ->join('combinations', 'combinations.commercial_id', '=','commercial_drugs.id')
                ->join('effective_materials', 'combinations.material_id', '=', 'effective_materials.id')
                ->join('companies', 'commercial_drugs.company_id', '=', 'companies.id')
                ->join('shipments', 'batch_numbers.shipment_id', '=', 'shipments.id')

                ->select('batch_numbers.batch_num','commercial_drugs.id', 'commercial_drugs.name as drug_name',
                    'commercial_drugs.drug_form','commercial_drugs.how_use','commercial_drugs.side_effects'
                    ,'effective_materials.name as material_name','shipments.exception','shipments.type','batch_numbers.drug_drawn',
                    'companies.name as company_name')
                ->where('batch_numbers.batch_num','=', $batch->batch_number)->get();
        }

        return view('operationsManagement.detailsReport', compact('reports' ,'drugs'));

    }

    //////////////// [ Details ..  تفاصيل المتابعة ]  ////////////////
    public function followedUp($report_no){

        $report = DB::table('reports')->select('reports.id')
            ->where('reports.id','=', $report_no)->get();  // search in given table id only
        if (!$report)
            return redirect()->back();

        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id as report_no','app_users.name as name_user','app_users.phone as phone_user'
                ,'reports.pharmacy_title','types_reports.name as type_report','reports.date',
                'reports.report_statuses','reports.batch_number','reports.opmanage_notes')

            ->where('reports.id','=', $report_no)->get();


        $procedures= DB::table('procedures')
            ->select('procedures.report_id','procedures.result','procedures.procedure','procedures.date')
            ->where('procedures.report_id','=',$report_no)->get();

//       return $reports;
        return view('operationsManagement/followedUp',compact('reports','procedures'));
    }

    //////////////// [ Details ..  الدواء ]  ////////////////
    public function detailsDrug($id){

        $batches = DB::table('reports')->select('reports.batch_number')
            ->where('reports.id', '=', $id)->get();

        foreach ($batches as $batch) {

            $drugs = DB::table('batch_numbers')
                ->join('commercial_drugs', 'batch_numbers.commercial_id', '=', 'commercial_drugs.id')
                ->join('combinations', 'combinations.commercial_id', '=', 'commercial_drugs.id')
                ->join('effective_materials', 'combinations.material_id', '=', 'effective_materials.id')
                ->join('companies', 'commercial_drugs.company_id', '=', 'companies.id')
                ->join('agents', 'commercial_drugs.agent_id', '=', 'agents.id')
                ->join('shipments', 'batch_numbers.shipment_id', '=', 'shipments.id')
                ->join('magnitude_drugs', 'magnitude_drugs.commercial_id', '=', 'commercial_drugs.id')
                ->join('magnitudes', 'magnitude_drugs.magnitude_id', '=', 'magnitudes.id')
                ->select('batch_numbers.batch_num', 'batch_numbers.barcode', 'batch_numbers.production_date',
                    'batch_numbers.expiry_date', 'batch_numbers.price', 'batch_numbers.quantity', 'batch_numbers.drug_drawn',
                    'commercial_drugs.id', 'commercial_drugs.name as drug_name', 'commercial_drugs.drug_form',
                    'commercial_drugs.how_use', 'commercial_drugs.side_effects', 'commercial_drugs.register_no',
                    'effective_materials.name as material_name', 'effective_materials.indications_use',
                    'companies.name as company_name', 'companies.country', 'shipments.exception','shipments.type',
                    'agents.name as agent_name', 'agents.phone', 'agents.email', 'agents.address',
                    'magnitudes.size', 'magnitudes.name')
                ->where('batch_numbers.batch_num', '=', $batch->batch_number)->get();
        }
        return view('operationsManagement/detailsDrug',compact('drugs'));
    }




    //////////////// [ Filter .. البلاغات المهربه ]  ////////////////
    public function newSmuggledReports()
    {
        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->select('reports.id','app_users.name as name_user'
                , 'reports.date', 'types_reports.name as type_report')

            ->where('types_reports.name','=','مهرب')
            ->where('state','=',0)
            ->get();

        return view('operationsManagement.newReports', compact('reports'));
    }

    //////////////// [ Filter .. البلاغات المسحوبة ]  ////////////////
    public function newDrownReports()
    {
        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->select('reports.id','app_users.name as name_user'
                , 'reports.date', 'types_reports.name as type_report')

            ->where('state','=',0)
            ->where('types_reports.name','=','مسحوب')
            ->get();
        return view('operationsManagement.newReports', compact('reports'));
    }

    //////////////// [ Filter .. البلاغات الغير مطابقة ]  ////////////////
    public function newDiffrentReports()
    {
        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->select('reports.id','app_users.name as name_user'
                , 'reports.date', 'types_reports.name as type_report')

            ->where('state','=',0)
            ->where('types_reports.name','=','غير مطابق')
            ->get();

        return view('operationsManagement.newReports', compact('reports'));
    }

    //////////////// [ Filter .. البلاغات المستثناه ]  ////////////////
    public function newExceptionReports()
    {
        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->select('reports.id','app_users.name as name_user'
                , 'reports.date', 'types_reports.name as type_report')

            ->where('state','=',0)
            ->where('types_reports.name','=','مستثناء')
            ->get();

        return view('operationsManagement.newReports', compact('reports'));
    }

    //////////////// [ Filter .. محول للمتابعة ]  ////////////////
    public function transferFollowingReports(){
        $reports = DB::table('reports')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->select('reports.id','reports.state','app_users.name as name_user',
                'reports.date', 'reports.transfer_date','reports.transfer_party','reports.transfer_party',
                'reports.report_statuses' , 'types_reports.name as type_report')

            ->where('report_statuses','=','محول للمتابعة')
            ->where('transfer_party','!=',null)
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();

//        $reports2 = DB::table('reports')
//            ->join('types_reports', 'reports.type_report_no', '=', 'types_reports.type_report_no')
//            ->select('reports.report_no','reports.authors_name',
//                'reports.report_date', 'reports.transfer_date','reports.transfer_party',
//                'reports.report_statues' , 'types_reports.type_report')
//            ->where('app_user_no','=',null)
//            ->where('report_statues','!=',null)
//            ->where('transfer_party','!=',null)
//            ->where('type_report','!=','اعراض جانبية')
//            ->where('type_report','!=','جودة')
//            ->get();

        return view('operationsManagement/followReports',compact('reports'));
    }

    //////////////// [ Filter .. قيد المتابع ]  ////////////////
    public function followingReports(){
        $reports = DB::table('reports')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->select('reports.id','reports.state','app_users.name as name_user',
                'reports.date', 'reports.transfer_date','reports.transfer_party','reports.transfer_party',
                'reports.report_statuses' , 'types_reports.name as type_report')

            ->where('report_statuses','=','قيد المتابعة')
            ->where('transfer_party','!=',null)
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();

//        $reports2 = DB::table('reports')
//            ->join('types_reports', 'reports.type_report_no', '=', 'types_reports.type_report_no')
//            ->select('reports.report_no','reports.authors_name',
//                'reports.report_date', 'reports.transfer_date','reports.transfer_party',
//                'reports.report_statues' , 'types_reports.type_report')
//            ->where('app_user_no','=',null)
//            ->where('report_statues','!=',null)
//            ->where('transfer_party','!=',null)
//            ->where('type_report','!=','اعراض جانبية')
//            ->where('type_report','!=','جودة')
//            ->get();

        return view('operationsManagement/followReports',compact('reports'));
    }

    //////////////// [ Filter .. تمت المتابعة ]  ////////////////
    public function followDoneReports(){
        $reports = DB::table('reports')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->select('reports.id','reports.state','app_users.name as name_user',
                'reports.date', 'reports.transfer_date','reports.transfer_party','reports.transfer_party',
                'reports.report_statuses' , 'types_reports.name as type_report')

            ->where('report_statuses','=','تمت المتابعة')
            ->where('transfer_party','!=',null)
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();

//        $reports2 = DB::table('reports')
//            ->join('types_reports', 'reports.type_report_no', '=', 'types_reports.type_report_no')
//            ->select('reports.report_no','reports.authors_name',
//                'reports.report_date', 'reports.transfer_date','reports.transfer_party',
//                'reports.report_statues' , 'types_reports.type_report')
//            ->where('app_user_no','=',null)
//            ->where('report_statues','!=',null)
//            ->where('transfer_party','!=',null)
//            ->where('type_report','!=','اعراض جانبية')
//            ->where('type_report','!=','جودة')
//            ->get();

        return view('operationsManagement/followReports',compact('reports'));
    }

    //////////////// [ Filter .. تم الانهاء ]  ////////////////
    public function doneReports(){
        $reports = DB::table('reports')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->select('reports.id','reports.state','app_users.name as name_user',
                'reports.date', 'reports.transfer_date','reports.transfer_party','reports.transfer_party',
                'reports.report_statuses' , 'types_reports.name as type_report')

            ->where('report_statuses','=','تم الانهاء')
            ->where('transfer_party','!=',null)
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();
        return view('operationsManagement/followReports',compact('reports'));
    }

}
