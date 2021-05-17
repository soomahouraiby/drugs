<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Report_alert_drug extends Model
{
    //use HasFactory;
    protected $table=" report_alert_drugs";
    protected $fillable = [
        'id', 'user_name',  'app_user_id', 'sex', 'age','weight','date_report',
         'length ', 'batch_number','method_obtaining','facility_name','facility_address','start_using_date',
         'take_drug ', 'purpose_use','dosage','stopped_using_date','stopped_using','describe_problem',
        						'types_report_id','relative_relation','notes','state'
    ];
    public $timestamps=false;
    protected $primaryKey = 'id';

}
