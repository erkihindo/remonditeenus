<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_note extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
}
