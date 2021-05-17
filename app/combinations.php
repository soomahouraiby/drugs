<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class combinations extends Model
{
    //
    public function commercial_drug(){
        return $this->belongsToMany(commercial_drug::class, 'combinations','commercial_id', 'material_id');

    }
}
