<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch_number extends Model
{
    //use HasFactory;
    protected $table="batch_numbers";
    protected $fillable = ['id','batch_num','barcode','production_date', 'expiry_date',
        'price','quantity','drug_drawn','exception',
        'commercial_id','shipment_no'];
    protected $primaryKey = 'id';
    public $timestamps=false;



}
