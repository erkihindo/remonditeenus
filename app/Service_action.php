<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_action extends Model
{
    public function service_type() {
        return $this->belongsTo('App\Service_type');
    }
}
