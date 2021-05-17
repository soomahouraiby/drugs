<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Types_report;
class Agent extends Model
{
    //use HasFactory;
    protected $table="agents";
    protected $fillable = ['id', 'name', 'phone', 'email', 'address',
    ];
    public $timestamps=false;





}
