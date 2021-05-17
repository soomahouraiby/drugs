<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Types_report;
class Diseases_app_user extends Model
{
    //use HasFactory;
    protected $table="diseases_app_users";
    protected $fillable = [
        'id','app_user_id','diseases_id'
    ];

    public $timestamps=false;


}
