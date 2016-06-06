<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_device extends Model
{
    public function device() {
        return $this->belongsTo('App\Device');
    }
}
