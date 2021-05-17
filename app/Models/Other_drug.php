<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Types_report;
class Other_drug extends Model
{
    //use HasFactory;
    protected $table="other_drugs";
    protected $fillable = [
        'id',
        'name',
        'dosage',
        'start_use_date',
        'end_use_date',
        'purpose_use','side_effect_id'

    ];
    public $timestamps=false;



}
