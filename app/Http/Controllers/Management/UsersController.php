<?php
namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Procedures;
use App\Models\Report_detailes;
use App\Models\Role;
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

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:المدير العام']);
    }

    public function index(){

        $users = DB::table('role_user')
            ->join('users','role_user.user_id','=','users.id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.name as user_name','users.district','users.phone','users.email',
                'users.id','roles.name as role_name')->get();


        return view('Management/users',compact('users'));

    }//end index

    public function edit($id){

        $users = User::all()->find($id);

        return view('Management/editUser',compact('users'));

    }//end of edit

    public function update(Request $request , $id)
    {

        $request->validate([
            'name'=>'required',
            'roles'=>'required|array|min:1'
        ]);

        $users = DB::table('users')
            ->select('id')->where('id','=',$id)->get();

        if (!$users)
            return redirect()->back();

//        $users->update((array)$request);
        $user=DB::table('users')
            ->select('id','address','district','phone','email','name')
            ->where('id','=',$id)
            ->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'district'=>$request->district
        ]);
        $user->syncRoles($request->roles);

        return redirect()->back();

    }//end of update

    public function add(){
       return view('Management/addUser');

    }//end of add

}
