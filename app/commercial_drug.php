<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commercial_drug extends Model
{
    //
    protected $guarded = [];
    public function batch_numbers(){
        return $this->hasMany(batch_numbers::class, 'commercial_id');
    }

    public function companies(){
        return $this->belongsTo(Companies::class, 'company_id');
    }
    public function Agents(){
        return $this->belongsTo(Agents::class, 'agent_id');
    }

    public function combinations(){
        return $this->belongsToMany(effective_material::class, 'combinations','commercial_id', 'material_id');
    }
    public function diseases(){
        return $this->belongsToMany(Diseases::class, 'diseases_commercials','commercial_id', 'diseases_id');
    }

}
