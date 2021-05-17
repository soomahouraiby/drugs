<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Types_report;
class Diseases extends Model
{
    //use HasFactory;
    protected $table="diseases";
    protected $fillable = [
        'id',
        'name',

    ];

    public $timestamps=false;


}
