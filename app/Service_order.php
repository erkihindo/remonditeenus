<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_order extends Model
{
    public function service_request() {
        return $this->belongsTo('App\Service_request');
    }
}
