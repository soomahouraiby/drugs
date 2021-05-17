<?php

namespace App\Models;

use App\Models\Commercial_drugs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\App_users;
use App\Models\Types_report;
use App\Models\Sites;
use App\Models\Shipments;
use App\Models\Procedures;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //use HasFactory;
    protected $table = "reports";
    protected $fillable =[
        'id','app_user_id','batch_number', 'types_report_id','date',
        'notes_user','district', 'commercial_name', 'material_name','drug_photo','drug_price',
        'company_name','agent_name','transfer_date', 'transfer_party', 'report_statuses'
        ,'opmanage_notes','state','pharmacy_title','street_name','neig_name','site_dec'
        ,'longitude','latitude','source','amount_name','phone','sex','age','adjective'
    ];
    protected $primaryKey = 'id';

    public $timestamps = false;

    public function type_report()
    {
        return $this->belongsTo(Type_report::class, 'types_report_id');
    }

    public function app_user()
    {
        return $this->belongsTo(App_user::class, 'app_user_id');
    }

    public function procedure(){
        return $this->hasMany('App\Models\Procedure','id');

    }





}
