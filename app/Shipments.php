<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipments extends Model
{
    //
    public function batch_numbers(){
        return $this->hasMany(batch_numbers::class);
    }
}
