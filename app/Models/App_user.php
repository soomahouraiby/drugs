<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_user extends Model
{
    //use HasFactory;
    protected $table="app_users";
    protected $fillable = [
        'id', 'name', 'phone', 'email',
        'age',  'sex','email_verified_at' ,'adjective','report_count'
    ];
    protected $primaryKey = 'id';
    public $timestamps=false;

    public function report(){
        return $this->hasMany('App\Models\Report','id');

    }

    public function disees(){
        return $this->belongsToMany('App\Models\Diseases',
            'app_user_diseases',
            'app_user_no',
            'disease_no',
            'app_user_no',
            'disease_no');
    }

}
