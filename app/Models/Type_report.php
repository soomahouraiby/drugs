<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class

Type_report extends Model
{
    //use HasFactory;
    protected $table="types_reports";
    protected $fillable = [
        'id',
        'name',

    ];

    public $timestamps=false;

    protected $primaryKey = 'id';


    public function report(){
        return $this->hasMany('App\Models\Report','id');

    }


}
