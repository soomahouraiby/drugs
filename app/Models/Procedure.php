<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reports;
class Procedure extends Model
{
    //use HasFactory;
    protected $table="procedures";
    protected $fillable = [
        'id',
        'procedure',
        'date',
        'result',
        'report_id'
    ];
    public $timestamps=false;
    protected $primaryKey = 'id';

    public function report(){
        return $this->belongsTo('App\Models\Report','report_id');

    }

}
