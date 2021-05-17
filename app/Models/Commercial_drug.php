<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Effective_materials;
use App\Models\Shipments;
use App\Models\Combinations;

class Commercial_drug extends Model
{
    //use HasFactory;
    protected $table="commercial_drugs";
    protected $filliable = [
        'id', 'name', 'register_no', 'drug_entrance','photo',
        'how_use', 'drug_form', 'side_effects', 'agent_id','company_id'
    ];
    public $timestamps=false;
    protected $primaryKey = 'id';

    public function report(){
        return $this -> hasMany('App\Models\Report','id');
    }

    public function effective_material(){
        return $this->belongsToMany('App\Models\Effective_material',
            'combinations',
            'commercial_id',
            'material_id',
            'id',
            'id');
    }

    public function shipment(){
        return $this->belongsToMany('App\Models\Shipment',
            'batch_numbers',
            'commercial_id',
            'shipment_id',
            'id',
            'id');
    }


    public function company(){
        return $this->belongsTo(Company::class,'company_id');
    }

    public function agent(){
        return $this -> belongsTo('App\Models\Agent','agent_id');
    }


}
