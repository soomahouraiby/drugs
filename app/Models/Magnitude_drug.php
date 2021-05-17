<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magnitude_drug extends Model
{
    protected $table="magnitude_drugs";
    protected $fillable = ['id','commercial_id','magnitude_id'];
    protected $primaryKey = 'id';

    public $timestamps=false;
}
