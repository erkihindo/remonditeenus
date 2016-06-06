<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function invoice_status_type() {
        return $this->belongsTo('App\Invoice_status_type');
    }
    
    public function service_order() {
        return $this->belongsTo('App\Service_order');
    }
}
