<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    //

    public function commercial_drugs_comp(){
        return  $this->hasMany(commercial_drug::class);

    }
}
