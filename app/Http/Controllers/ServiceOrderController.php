<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service_order;
use App\Service_request;
use App\Service_part;
use App\Service_action;
use App\Service_device;

use Illuminate\Support\Facades\Auth;

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
    
    public function viewCustomerOrders() {
        $orders = Service_order::get();
        $customerOrders = [];
        
        foreach($orders as $order) {
            if($order->service_request->user_id == Auth::user()->id) {
                array_push($customerOrders, $order);
            }
        }
        return view('customer/customerorders', ['orders' => $customerOrders]);
    }
    
    public function createOrder(Request $request) {
        
        $newOrder = new Service_order();
        $newOrder->service_request_id = $request->requestID;
        $newOrder->so_status_type_id = $request->order_status;
        $newOrder->status_changed_by = Auth::user()->id;
        $newOrder->price_total = $request->price_total;
        $newOrder->created_by = Auth::user()->id;
        $newOrder->updated_by = Auth::user()->id;
        $newOrder->save();
        
        $newSerDev = new Service_device();
        $newSerDev->device_id = $request->device;
        $newSerDev->service_device_status_type_id = 1;
        $newSerDev->service_order_id = $newOrder->id;
        
        $newSerDev->to_store = date('Y-m-d H:i:s');
        $newSerDev->from_store = date('Y-m-d H:i:s');
        $newSerDev->save();
        
        for($i = 0; $i <count($request->service); $i++) {
            $newAction = new Service_action();
            $newAction->action_description = $request->service[$i];
            $newAction->service_action_status_type_id = 1;
            $newAction->service_type_id = $request->service_type[$i];
            $newAction->service_device_id = $newSerDev->id;
            $newAction->service_order_id = $newOrder->id;
            $newAction->service_amount = $request->amount1[$i];
            $newAction->price = $request->unit_price1[$i];
            $newAction->save();
        }
        
        for($j = 0; $j <count($request->part); $j++) {
            $newPart = new Service_part();
            $newPart->part_name = $request->part[$j];
            $newPart->service_device_id = $newSerDev->id;
            $newPart->service_order_id = $newOrder->id;
            $newPart->part_price = $request->unit_price2[$j];
            $newPart->part_count = $request->amount2[$j];
            $newPart->created_by = Auth::user()->id;
            $newPart->save();
            
        }
        
        dd("Saved all");
    }
}
