<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_type extends Model
{
    public function service_unit_type() {
        return $this->belongsTo('App\Service_unit_type');
    }
}
