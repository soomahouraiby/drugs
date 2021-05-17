<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Types_report;
class Diseases_commercial extends Model
{
    //use HasFactory;
    protected $table="diseases_commercials";
    protected $fillable = [
        'id','commercial_id','diseases_id'
    ];

    public $timestamps=false;


}
