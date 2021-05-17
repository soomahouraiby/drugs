<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Types_report;
class Company extends Model
{
    //use HasFactory;
    protected $table="companies";
    protected $fillable = [
        'id',
        'name',
        'country',

    ];
    public $timestamps=false;



}
