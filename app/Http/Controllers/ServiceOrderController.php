<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service_order;
use App\Service_request;

class ServiceOrderController extends Controller
{
    public function index($servicerequest)
    {
        
        $request = Service_request::find($servicerequest);
        if($request == null) {
            dd("There are no requests, please make one");
        }
        $maxID = Service_order::max('id');
        $newID = $maxID +1;
        
        return view('employee/serviceorder', 
            ['newID' => $newID,
            'servicerequest' => $request,
                
                ]);
    }
}
