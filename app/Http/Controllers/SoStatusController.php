<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\So_status_type;

class SoStatusController extends Controller
{
    public function getAll() {
        $types = So_status_type::get();
        $typeList = [];
        
        foreach ($types as $type) {
            array_push($typeList,  array($type->id, $type->type_name));
        }
        return response()->json($typeList,200);
    
    }
    
}
