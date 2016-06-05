<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_request extends Model
{
    public function service_request_status_type() {
        return $this->belongsTo('App\Service_request_status_type');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
    
     public function admin()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
