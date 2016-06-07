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
        
        $oldOrder = Service_order::where('service_request_id', $servicerequest)->first();
        
        
        return view('employee/serviceorder', 
            ['newID' => $newID,
            'servicerequest' => $request,
             'oldOrder' => $oldOrder,   
                ]);
    }
    
    public function getAll() {
        $orders = Service_order::get();
        return view('employee/allserviceorders', ['orders' => $orders]);
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
        
//        $newOrder = new Service_order();
//        $newOrder->service_request_id = $request->requestID;
//        $newOrder->so_status_type_id = $request->order_status;
//        $newOrder->status_changed_by = Auth::user()->id;
//        $newOrder->price_total = $request->price_total;
//        
//        $newOrder->created_by = Auth::user()->id;
//        $newOrder->updated_by = Auth::user()->id;
//        $newOrder->save();
//        
//        $newSerDev = new Service_device();
//        $newSerDev->device_id = $request->device;
//        $newSerDev->service_device_status_type_id = 1;
//        $newSerDev->service_order_id = $newOrder->id;
//        
//        $newSerDev->to_store = date('Y-m-d H:i:s');
//        $newSerDev->from_store = date('Y-m-d H:i:s');
//        $newSerDev->save();
//        
//        for($i = 0; $i <count($request->service); $i++) {
//            $newAction = new Service_action();
//            $newAction->action_description = $request->service[$i];
//            $newAction->service_action_status_type_id = 1;
//            $newAction->service_type_id = $request->service_type[$i];
//            $newAction->service_device_id = $newSerDev->id;
//            $newAction->service_order_id = $newOrder->id;
//            $newAction->created_by = Auth::user()->id;
//            $newAction->service_amount = $request->amount1[$i];
//            $newAction->price = $request->unit_price1[$i];
//            $newAction->save();
//        }
//        
//        for($j = 0; $j <count($request->part); $j++) {
//            $newPart = new Service_part();
//            $newPart->part_name = $request->part[$j];
//            $newPart->service_device_id = $newSerDev->id;
//            $newPart->service_order_id = $newOrder->id;
//            $newPart->part_price = $request->unit_price2[$j];
//            $newPart->part_count = $request->amount2[$j];
//            $newPart->created_by = Auth::user()->id;
//            $newPart->save();
//            
//        }
        
        dd("Called createOrder");
    }
    public function findSoStateByID(Request $request) {
        $oldOrder = Service_order::find($request->id);
        return response()->json($oldOrder->so_status_type->id,200);
        
    }
    
    public function saveOrder(Request $request) {
        $order = new Service_order();
        $order->service_request_id = $request->oldReqID;
        $order->so_status_type_id = $request->so_status_type_id;
        $order->status_changed_by = Auth::user()->id;   
        $order->price_total = $request->price_total;
       
        $order->updated_by = Auth::user()->id;
        $order->save();
        
        foreach($request->services as $action) {
            $newAction = new Service_action();
            $newAction->action_description = $action['serviceDescription'];
            $newAction->service_action_status_type_id = 1;
            $newAction->service_type_id = $action['serviceType'];
            $newAction->service_device_id = $request->service_device;
            $newAction->service_order_id = $order->id;
            $newAction->created_by = Auth::user()->id;
            $newAction->service_amount = $action['serviceAmount'];
            $newAction->price = $action['serviceUnitPrice'];
            $newAction->save();
        }
        foreach($request->parts as $part) {
            $newPart = new Service_part();
            $newPart->part_name = $part['partDescription'];
            $newPart->service_device_id = $request->service_device;
            $newPart->service_order_id = $order->id;
            $newPart->created_by = Auth::user()->id;
            $newPart->part_count = $part['partAmount'];
            $newPart->part_price = $part['partUnitPrice'];
            $newPart->save();
        }
        $newServiceDevice = new Service_device();
        $newServiceDevice->device_id = $request->service_device;
        $newServiceDevice->service_order_id = $order->id;
        $newServiceDevice->save();
        \Illuminate\Support\Facades\Log::info('Created' . $order);
        return response()->json($order,200);
        
    }
    public function updateOrder(Request $request) {
        
        $order = Service_order::find($request->id);
        if($order->so_status_type_id != $request->so_status_type_id) {
            $order->so_status_type_id = $request->so_status_type_id;
            $order->status_changed_by = Auth::user()->id;
        }        
        $order->price_total = $request->price_total;
       
        $order->updated_by = Auth::user()->id;
        $order->update();
        
        Service_action::where('service_order_id', $request->id)->delete();
        foreach($request->services as $action) {
            $newAction = new Service_action();
            $newAction->action_description = $action['serviceDescription'];
            $newAction->service_action_status_type_id = 1;
            $newAction->service_type_id = $action['serviceType'];
            $newAction->service_device_id = $request->service_device;
            $newAction->service_order_id = $order->id;
            $newAction->created_by = Auth::user()->id;
            $newAction->service_amount = $action['serviceAmount'];
            $newAction->price = $action['serviceUnitPrice'];
            $newAction->save();
        }
        Service_part::where('service_order_id', $request->id)->delete();
        foreach($request->parts as $part) {
            $newPart = new Service_part();
            $newPart->part_name = $part['partDescription'];
            $newPart->service_device_id = $request->service_device;
            $newPart->service_order_id = $order->id;
            $newPart->created_by = Auth::user()->id;
            $newPart->part_count = $part['partAmount'];
            $newPart->part_price = $part['partUnitPrice'];
            $newPart->save();
        }
        Service_device::where('service_order_id', $request->id)->delete();
        $newServiceDevice = new Service_device();
        $newServiceDevice->device_id = $request->service_device;
        $newServiceDevice->service_order_id = $order->id;
        $newServiceDevice->save();
        \Illuminate\Support\Facades\Log::info('Updated' . $order);
        return response()->json($order,200);
        
    }
}
