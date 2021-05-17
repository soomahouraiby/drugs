<?php
namespace App\Http\Controllers\pharmacyManagement;

use App\Http\Controllers\Controller;
use App\Models\Procedures;
use App\Models\Report;
use App\Models\Report_detailes;
use App\Models\Sites;
use App\Models\Commercial_drugs;
use App\Models\App_users;
use App\Models\Reports;
use App\Models\Types_report;
use App\Request\ReportsRequest;
use App\Models\Shipments;
use App\Models\Combinations;
use App\Models\Effective_materials;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Type;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class ManageController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:مدير الصيدلة']);
    }

    //////////////// [ Show .. بلاغات وارده ]  ////////////////
    public function newReports(){

        $reports=DB::table('reports')

            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id as id_report','app_users.name as name_user','reports.state',
                'reports.date','reports.transfer_party', 'types_reports.name as type_report','reports.pharmacy_title')

            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('state','=',1)
            ->where('transfer_party','=','ادارة الصيدلة')
            ->where('types_reports.name','!=','جودة')
            ->get();

        return view('pharmacyManagement/newReports',compact('reports'));
    }

    //////////////// [ Show .. متابعة البلاغات الوارده ]  ////////////////
    public function followReports(){

        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id','reports.state','app_users.name as name_user',
                'reports.date', 'reports.transfer_date','reports.transfer_party','reports.pharmacy_title',
                'reports.report_statuses' , 'types_reports.name as type_report')

            ->where('transfer_party','!=',null)
            ->where('state','=',2)
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();

//        return $reports;
        return view('pharmacyManagement/followReports',compact('reports'));
    }




    //////////////// [ Follow .. متابعة بلاغ وارد ]  ////////////////
    public function followNewReport($report_no){

        $report = DB::table('reports')->select('reports.id')
            ->where('id','=', $report_no)->get();  // search in given table id only
        if (!$report)
            return redirect()->back();

        $update = DB::table('reports')->where('id','=', $report_no)
            ->update(['reports.report_statuses'=>'قيد المتابعة','state'=>2]);


        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id as report_no','reports.batch_number','app_users.name as name_user','app_users.phone as phone_user'
                ,'reports.pharmacy_title','types_reports.name as type_report','reports.date','reports.report_statuses')

            ->where('reports.id','=', $report_no)->get();

        return view('pharmacyManagement/follow',compact('reports'));
    }

    //////////////// [ Follow .. إنهاء البلاغ ]  ////////////////
    public function endFollowUp($report_no): \Illuminate\Http\RedirectResponse
    {
        $report = DB::table('reports')->select('reports.id')
            ->where('id','=', $report_no)->get();
        if (!$report)
            return redirect()->back();

        $reports=DB::table('reports')
            ->select('reports.id as report_no','reports.report_statuses')
            ->where('reports.id','=', $report_no)->update(['report_statuses'=>'تمت المتابعة']);

        return redirect()->back()->with(['saved'=>'تم التعديل']);
    }

    //////////////// [ Follow ..  اضافة إجراء ]  ////////////////
    public function addProcedure(Request $request,$report_no): \Illuminate\Http\RedirectResponse
    {
        DB::table('procedures')->insert([
            'date'=>Carbon::now()->toDateTimeString(),
            'procedure'=>$request->input('procedure'),
            'result'=>$request->input('result'),
            'report_id'=>$report_no]);

        return redirect()->route('PM_detailsFollow',$report_no);

    }




    //////////////// [ Drug ..   ]  ////////////////
    public function drug(){
        $agents = DB::table('agents')->select('agents.agent_name','agents.agent_no')->get();

        $companies = DB::table('companies')->select('companies.company_name','companies.company_no')->get();

        $materials = DB::table('effective_material')->select('effective_material.material_no','effective_material.material_name')->get();

        $drug=Commercial_drugs::orderByDesc('drug_no')->first('drug_no');
        $shipment=Shipments::orderByDesc('shipment_no')->first('shipment_no');


        return view('pharmacyManagement/addDrug',compact('agents','companies','materials','drug','shipment'));
    }

    //////////////// [ Drug ..  اضافة دواء ]  ////////////////
    public function addDrug(Request $request){
-
        $drugs = DB::table('commercial_drug')->insert([
            'drug_name'=>$request->drug_name,
            'register_no'=>$request->register_no,
            'drug_entrance'=>'احلام',
            'drug_photo'=>'ااا',
            'how_to_use'=>$request->how_to_use,
            'drug_form'=>$request->drug_form,
            'side_effects'=>$request->side_effects,
            'agent_no'=>$request->agent_no,
            'company_no'=>$request->company_no]);

        $combination = DB::table('combination')->insert([
            'material_no'=>$request->material_no,
            'drug_no'=>$request->drug_no,
            'con'=>$request->con]);

        $shipments = DB::table('shipments')->insert([
            'production_date'=>$request->production_date,
            'expiry_date'=>$request->expiry_date,
            'quantity'=>$request->quantity,
            'price'=>$request->price
        ]);

        $batch_number = DB::table('batch_number')->insert([
            'batch_num'=>$request->batch_num,
            'barcode'=>$request->barcode,
            'drug_no'=>$request->drug_no,
            'shipment_no'=>$request->shipment_no
        ]);

        return redirect()->back();
    }




    //////////////// [ Details ..  بلاغ وارد ]  ////////////////
    public function detailsReport($report_no){
        $report = DB::table('reports')->select('reports.id')
            ->where('id','=', $report_no)->get();

        if (!$report)
            return redirect()->back();

        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id as id_report','reports.drug_picture','reports.notes_user', 'reports.date',
                'reports.drug_price','reports.commercial_name','reports.company_name','reports.agent_name',
                'reports.site_dec','reports.neig_name','reports.pharmacy_title','reports.street_name',
                'app_users.name as name_user', 'app_users.phone as phone_user', 'app_users.adjective'
                , 'app_users.age','app_users.report_count','reports.report_statuses',
                'types_reports.name as type_report')
            ->where('reports.id', '=', $report_no)->get();


        $batches = DB::table('reports')->select('reports.batch_number as batch_number')
            ->where('reports.id', '=', $report_no)->get();

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


        return view('pharmacyManagement.detailsReport', compact('reports' , 'drugs'));

    }

    //////////////// [ Details ..  دواء ]  ////////////////
    public function detailsDrug($report_no){

        $batches = DB::table('reports')->select('reports.batch_number')
            ->where('reports.id', '=', $report_no)->get();

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
        return view('pharmacyManagement/detailsDrug',compact('drugs'));
    }

    //////////////// [ Details ..  تفاصيل المتابعة ]  ////////////////
    public function detailsFollow($report_no){
        $report = DB::table('reports')->select('reports.id')
            ->where('id','=', $report_no)->get();  // search in given table id only
        if (!$report)
            return redirect()->back();

        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id as report_no','app_users.name as name_user','app_users.phone as phone_user'
                ,'reports.pharmacy_title','types_reports.name as type_report','reports.date','reports.report_statuses','reports.batch_number')

            ->where('reports.id','=', $report_no)->get();


       $procedures= DB::table('procedures')
           ->select('procedures.report_id','procedures.result','procedures.procedure','procedures.date')
           ->where('procedures.report_id','=',$report_no)->get();

//       return $reports;
        return view('pharmacyManagement/follow',compact('reports','procedures'));
    }




    //////////////// [ Filter .. البلاغات المهربه ]  ////////////////
    public function newSmuggledReports()
    {
        $reports=DB::table('reports')

            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id as id_report','app_users.name as name_user','reports.state',
                'reports.date','reports.transfer_party', 'types_reports.name as type_report','reports.pharmacy_title')

            ->where('state','=',1)
            ->where('types_reports.name','=','مهرب')
            ->where('transfer_party','=','ادارة الصيدلة')
            ->get();

        return view('pharmacyManagement.newReports', compact('reports'));
    }

    //////////////// [ Filter .. البلاغات المسحوبه ]  ////////////////
    public function newDrownReports()
    {
        $reports=DB::table('reports')

            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id as id_report','app_users.name as name_user','reports.state',
                'reports.date','reports.transfer_party', 'types_reports.name as type_report','reports.pharmacy_title')

            ->where('state','=',1)
            ->where('types_reports.name','=','مسحوب')
            ->where('transfer_party','=','ادارة الصيدلة')
            ->get();

        return view('pharmacyManagement.newReports', compact('reports'));
    }

    //////////////// [ Filter .. البلاغات الغير مطابقة ]  ////////////////
    public function newDifferentReports()
    {
        $reports=DB::table('reports')

            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id as id_report','app_users.name as name_user','reports.state',
                'reports.date','reports.transfer_party', 'types_reports.name as type_report','reports.pharmacy_title')

            ->where('state','=',1)
            ->where('types_reports.name','=','غير مطابق')
            ->where('transfer_party','=','ادارة الصيدلة')
            ->get();

        return view('pharmacyManagement.newReports', compact('reports'));
    }

    //////////////// [ Filter .. البلاغات المستثناه ]  ////////////////
    public function newExceptionReports()
    {
        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->select('reports.id','app_users.name as name_user','reports.pharmacy_title',
                 'reports.date', 'types_reports.name as type_report')

            ->where('state','=',0)
            ->where('types_reports.name','=','مستثناء')
            ->get();

        return view('operationsManagement.newReports', compact('reports'));
    }

    //////////////// [ Filter .. بلاغات قيد المتابعة ]  ////////////////
    public function followingReports(){

        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id as id_report','reports.state','app_users.name as name_user',
                'reports.date', 'reports.transfer_date','reports.transfer_party','reports.pharmacy_title',
                'reports.report_statuses' , 'types_reports.name as type_report')

            ->where('report_statuses','=','قيد المتابعة')
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();

        return view('pharmacyManagement/followReports',compact('reports'));
    }

    //////////////// [ Filter .. بلاغات تمت المتابعة ]  ////////////////
    public function followDoneReports(){

        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id as id_report','reports.state','app_users.name as name_user',
                'reports.date', 'reports.transfer_date','reports.transfer_party','reports.pharmacy_title',
                'reports.report_statuses' , 'types_reports.name as type_report')

            ->where('report_statuses','=','تمت المتابعة')
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();

        return view('pharmacyManagement/followReports',compact('reports'));
    }

}
