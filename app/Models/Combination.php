<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Types_report;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Combination extends Pivot
{
    //use HasFactory;
    protected $table="combinations";
    protected $fillable = ['id', 'material_id', 'commercial_id'];
    public $timestamps=false;

}
