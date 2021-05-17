<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magnitude extends Model
{
    protected $table="magnitudes";
    protected $fillable = ['id','name','size'];
    protected $primaryKey = 'id';

    public $timestamps=false;
}
