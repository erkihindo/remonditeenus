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
            array_push($serviceList,  array($service->type_name, $service->service_unit_type->type_name, $service->service_price));
        }
        return response()->json($serviceList,200);
    }
}
