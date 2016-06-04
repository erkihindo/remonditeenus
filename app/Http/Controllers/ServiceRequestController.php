<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service_request;
class ServiceRequestController extends Controller
{
    public function index()
    {
        $maxID = Service_request::max('id');
        $newID = $maxID +1;
        
        return view('employee/servicerequest', ['newID' => $newID]);
    }
    
    public function createRequest(Request $request) {
        dd($request);
    }
}
