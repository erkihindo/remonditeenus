<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_order extends Model
{
    public function service_request() {
        return $this->belongsTo('App\Service_request');
    }
    public function so_status_type() {
        return $this->belongsTo('App\So_status_type');
    }
    public function actions() {
        return $this->hasMany('App\Service_action');
    }
    
    public function parts() {
        return $this->hasMany('App\Service_part');
    }
    
    public function devices() {
        return $this->hasMany('App\Service_device');
    }
    
    
}
