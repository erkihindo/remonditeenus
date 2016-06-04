<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service_request;
use App\User;

use Illuminate\Support\Facades\Auth;

class ServiceRequestController extends Controller
{
    public function index()
    {
        $maxID = Service_request::max('id');
        $newID = $maxID +1;
        
        return view('employee/servicerequest', ['newID' => $newID]);
    }
    
    public function createRequest(Request $request) {
        $customer = User::where('name', $request->customer)->first();
        $newSerReq = new Service_request();
        $newSerReq->service_request_status_type_id = 1;
        $newSerReq->user_id = $customer->id;
        $newSerReq->created_by = Auth::user()->id;
        $newSerReq->service_desc_by_customer = $request->customer_desc;
        $newSerReq->service_desc_by_employee = $request->employee_desc;
        
        if($newSerReq->save()) {
            return redirect()->route('serviceorder', ['servicerequest' => $newSerReq]);
        } else {
            return redirect('servicerequest');
        }
        
    }
}
