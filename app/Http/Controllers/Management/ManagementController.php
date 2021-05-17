<?php
namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Procedures;
use App\Models\Report_detailes;
use App\Models\Sites;
use App\Models\Commercial_drugs;
use App\Models\App_users;
use App\Models\Reports;
use App\Models\Types_report;
use App\Models\User;
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
use phpDocumentor\Reflection\Types\Nullable;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class ManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:المدير العام']);
    }


    //////////////// [ Show .. بلاغات وارده ]  ////////////////
    public function showReports(){
        $reports=DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->select('reports.id','app_users.name as name_user','reports.report_statuses' ,'reports.state',
                'reports.date','reports.transfer_party', 'types_reports.name as type_report','reports.transfer_date')
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();
        return view('Management/showReports',compact('reports'));
    }




    //////////////// [ Details .. البلاغ ]  ////////////////
    public function report($report_no){
        $report = DB::table('reports')->select('reports.id')
            ->where('reports.id','=', $report_no)->get();  // search in given table id only
        if (!$report)
            return redirect()->back();

        $reports = DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')

            ->select('reports.id','reports.amount_name','reports.phone as amount_phone','reports.opmanage_notes',
                'app_users.name as name_user','app_users.phone as phone_user','reports.commercial_name'
                ,'reports.pharmacy_title','types_reports.name as type_report','reports.date','reports.report_statuses')

            ->where('reports.id','=', $report_no)->get();

        $procedures= DB::table('procedures')
            ->select('procedures.report_id','procedures.result','procedures.procedure','procedures.date')
            ->where('report_id','=',$report_no)->get();

        return view('Management/report',compact('reports','procedures'));
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
                    ,'effective_materials.name as material_name','shipments.exception','batch_numbers.drug_drawn',
                    'companies.name as company_name')
                ->where('batch_numbers.batch_num','=', $batch->batch_number)->get();
        }


        return view('Management.detailsReport', compact('reports' , 'drugs'));

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
                    'companies.name as company_name', 'companies.country', 'shipments.exception',
                    'agents.name as agent_name', 'agents.phone', 'agents.email', 'agents.address',
                    'magnitudes.size', 'magnitudes.name')
                ->where('batch_numbers.batch_num', '=', $batch->batch_number)->get();
        }
        return view('Management/detailsDrug',compact('drugs'));
    }




    //////////////// [ Filter .. بلاغات وارده ]  ////////////////
    public function showNewReports(){
        $reports=DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->select('reports.id','app_users.name as name_user','reports.report_statuses' ,'reports.state',
                'reports.date','reports.transfer_party', 'types_reports.name as type_report','reports.transfer_date')
            ->where('transfer_date','=',null)
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();
        return view('Management/showReports',compact('reports'));
    }

    //////////////// [ Filter .. بلاغات محول للمتابعة ]  ////////////////
    public function showTransferReports(){
        $reports=DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->select('reports.id','app_users.name as name_user','reports.report_statuses' ,'reports.state',
                'reports.date','reports.transfer_party', 'types_reports.name as type_report','reports.transfer_date')
            ->where('report_statuses','=','محول للمتابعة')
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();
        return view('Management/showReports',compact('reports'));
    }

    //////////////// [ Filter .. بلاغات قيد المتابعة ]  ////////////////
    public function showFollowingReports(){
        $reports=DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->select('reports.id','app_users.name as name_user','reports.report_statuses' ,'reports.state',
                'reports.date','reports.transfer_party', 'types_reports.name as type_report','reports.transfer_date')
            ->where('report_statuses','=','قيد المتابعة')
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();

        return view('Management/showReports',compact('reports'));
    }

    //////////////// [ Filter .. بلاغات تمت المتابعة ]  ////////////////
    public function showFollowDoneReports(){
        $reports=DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->select('reports.id','app_users.name as name_user','reports.report_statuses' ,'reports.state',
                'reports.date','reports.transfer_party', 'types_reports.name as type_report','reports.transfer_date')
            ->where('report_statuses','=','تمت المتابعة')
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();
        return view('Management/showReports',compact('reports'));
    }

    //////////////// [ Filter .. بلاغات تم الانهاء ]  ////////////////
    public function showDoneReports(){
        $reports=DB::table('reports')
            ->join('types_reports', 'reports.types_report_id', '=', 'types_reports.id')
            ->join('app_users', 'reports.app_user_id', '=', 'app_users.id')
            ->select('reports.id','app_users.name as name_user','reports.report_statuses' ,'reports.state',
                'reports.date','reports.transfer_party', 'types_reports.name as type_report','reports.transfer_date')
            ->where('report_statuses','=','تم الانهاء')
            ->where('types_reports.name','!=','اعراض جانبية')
            ->where('types_reports.name','!=','جودة')
            ->get();
        return view('Management/showReports',compact('reports'));
    }

}
