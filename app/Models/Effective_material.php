<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Effective_material extends Model
{
    //use HasFactory;
    protected $table="effective_materials";
    protected $fillable = [
        'id', 'name', 'indications_use',
    ];

    public $timestamps=false;
    protected $primaryKey = 'id';


    public function commercial_drug(){
        return $this->belongsToMany('App\Models\Commercial_drugs',
            'combinations',
            'material_id',
            'commercial_id',
            'id',
            'id');

    }
}
