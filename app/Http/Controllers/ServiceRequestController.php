<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service_request;
use App\User;

use Illuminate\Support\Facades\Auth;

class ServiceRequestController extends Controller
{
    public function newRequest()
    {
        $maxID = Service_request::max('id');
        $newID = $maxID +1;
        
        return view('employee/servicerequest', ['newID' => $newID]);
    }
    
     public function editRequest($id)
    {
        $request = Service_request::find($id);
        return view('employee/editrequest', ['request' => $request]);
    }
    
    
    
    public function allRequests()
    {
        $requests = Service_request::get();
        
        return view('employee/allservicerequests', ['requests' => $requests]);
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
            \Illuminate\Support\Facades\Log::info('Created' . $newSerReq);
            return redirect()->route('serviceorder', ['servicerequest' => $newSerReq]);
        } else {
            return redirect('servicerequest');
        }
        
    }
    
    public function updateRequest(Request $request) {
        
        $newRequest = Service_request::find($request->id);
        
        if($request->status_type == "true") {
            $newRequest->service_request_status_type_id = 2;
        } else {
            $newRequest->service_request_status_type_id = 1;
        }
        $customer = User::where('name', $request->customer)->first();
        $newRequest->user_id = $customer->id;
        $newRequest->created_by = Auth::user()->id;
        $newRequest->service_desc_by_customer = $request->customer_desc;
        $newRequest->service_desc_by_employee = $request->employee_desc;
        if($newRequest->update()) {
            return response()->json($newRequest,200);
        } 
    }
    
    public function updateRequesttwo(Request $request) {
        
        $newRequest = Service_request::find($request->id);
        
        if($request->is_rejected == true) {
            $newRequest->service_request_status_type_id = 2;
        } else {
            $newRequest->service_request_status_type_id = 1;
        }
        $customer = User::where('name', $request->customer)->first();
        $newRequest->user_id = $customer->id;
        $newRequest->created_by = Auth::user()->id;
        $newRequest->service_desc_by_customer = $request->customer_desc;
        $newRequest->service_desc_by_employee = $request->employee_desc;
        if($newRequest->update()) {
            return redirect()->route('serviceorder', ['servicerequest' => $newRequest]);
        } 
    }
    
    public function saveRequest(Request $request) {
        $newRequest = new Service_request();
        if($request->status_type == "true") {
            $newRequest->service_request_status_type_id = 2;
        } else {
            $newRequest->service_request_status_type_id = 1;
        }
        $customer = User::where('name', $request->customer)->first();
        $newRequest->user_id = $customer->id;
        $newRequest->created_by = Auth::user()->id;
        $newRequest->service_desc_by_customer = $request->customer_desc;
        $newRequest->service_desc_by_employee = $request->employee_desc;
        if($newRequest->save()) {
            return response()->json($request,200);
        } 
        
    }
}
