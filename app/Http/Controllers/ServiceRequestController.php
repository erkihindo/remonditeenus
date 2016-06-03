<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ServiceRequestController extends Controller
{
    public function index()
    {
        
        return view('employee/servicerequest');
    }
    
    public function createRequest(Request $request) {
        dd($request);
    }
}
