<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class batch_numbers extends Model
{
    //

    public function commercial_drugs(){
        return  $this->belongsTo(commercial_drug::class,'commercial_id');

    }
    public function shipments(){
        return  $this->belongsTo(Shipments::class,'shipment_id');

    }
}
