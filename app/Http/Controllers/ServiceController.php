<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service_type;

class ServiceController extends Controller
{
    public function getAll() {
        $services = Service_type::get();
        $serviceList = [];
        foreach ($services as $service) {
            array_push($serviceList,  $service->type_name);
        }
        return response()->json($serviceList,200);
    }
}
