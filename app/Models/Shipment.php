<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Types_report;
class Shipment extends Model
{
    //use HasFactory;
    protected $table="shipments";
    protected $fillable = ['id', 'type',

    ];
    protected $primaryKey = 'id';

    public $timestamps=false;

    public function drug(){
        return $this->belongsToMany('App\Models\commercial_drug',
            'batch_numbers',
            'shipment_id',
            'commercial_id',
            'id',
            'id');
    }



}
