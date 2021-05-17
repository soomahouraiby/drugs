<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Types_report;
class Side_effect extends Model
{
    //use HasFactory;
    protected $table="side_effects";
    protected $fillable = [
        'id',
        'report_alert_drug_id',
        'start_side_effect',
        'severity',
        'sideshow_still',
        'date_end_side','patient_condition',
        'inform_doctor','doctor_name','doctor_hospital','doctor_phone',

    ];
    public $timestamps=false;

}
