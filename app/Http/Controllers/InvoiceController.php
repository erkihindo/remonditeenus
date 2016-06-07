<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Invoice;
use App\Invoice_status_type;
use App\Service_request;
use App\Service_order;
use App\User;
use App\Service_action;
use App\Service_part;
use App\Invoice_row;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('employee/invoice');
    }
    
    public function showAll() {
        $invoices = Invoice::get();
        return view('employee/invoices', ['invoices' => $invoices]);
    }


    public function newInvoice(Request $request) {
        $request = Service_request::find($request->requestID);
        $order = Service_order::where('service_request_id', $request->id)->first();
        $allInvoiceCount = count(Invoice::get());
        $newID = $allInvoiceCount +1;
       
        return view('employee/invoice', ['newID' => $newID,
            'serviceorder' => $order]);
    }
    public function getTypes() {
        $types = Invoice_status_type::get();
        return response()->json($types,200);
    }
    public function createInvoice(Request $request) {
        
        $newInvoice = new Invoice();
        $customer = User::where('name', $request->customer)->get();
        
        $newInvoice->customer_id = $customer[0]->id;
        $newInvoice->invoice_status_type_id = $request->order_status;
        $newInvoice->service_order_id = $request->orderID;
     
        $Date1  = date('Y-m-d');
        
        $Date2 = date('Y-m-d', strtotime($Date1 . " + $request->date day"));
        
        $newInvoice->due_date = $Date2;
        $newInvoice->receiver_name = $request->customer;
        $newInvoice->timestamps = false;
        $newInvoice->save();
        $actions = Service_action::where('service_order_id', $request->orderID)->get();
        foreach($actions as $action) {
            $invRow = new Invoice_row();
            $invRow->service_action_id = $action->id;
            $invRow->invoice_id = $newInvoice->id;
            $invRow->action_part_description = $action->action_description;
            $invRow->amount = $action->service_amount;
            $invRow->unit_price = $action ->price;
            $invRow->timestamps = false;
            $invRow->save();
        }
        
        $parts = Service_part::where('service_order_id', $request->orderID)->get();
        
        foreach($parts as $part) {
            $newpart = new Invoice_row();
            $newpart->service_part_id = $part->id;
            $newpart->invoice_id = $newInvoice->id;
            
            $newpart->action_part_description = $part->part_name;
            $newpart->amount = $part->part_count;
            $newpart->unit_price = $part ->part_price;
            $newpart->timestamps = false;
            
            $newpart->save();
        }
        
        
        \Illuminate\Support\Facades\Log::info('Created' . $newInvoice);
       
            return redirect()->route('invoices');
       
        
    }
    
    public function updateInvoice(Request $request) {
        
        $newInvoice = Invoice::find($request->invoice_id);
        $customer = User::where('name', $request->customer)->get();
        
        $newInvoice->customer_id = $customer[0]->id;
        $newInvoice->invoice_status_type_id = $request->order_status;
        $newInvoice->service_order_id = $request->orderID;
        if($request->date > 0) {
             $Date1  = date('Y-m-d');
        
            $Date2 = date('Y-m-d', strtotime($Date1 . " + $request->date day"));
        
            $newInvoice->due_date = $Date2;
        }
       
        $newInvoice->receiver_name = $request->customer;
        $newInvoice->timestamps = false;
        if($newInvoice->update()) {
            return redirect()->route('invoices');
        }
        
    }
    
    public function openEdit($id) {
            $invoice = Invoice::find($id);
            $order = Service_order::find($invoice->service_order_id);
            $allInvoiceCount = count(Invoice::get());
            $id = $invoice->id;
            return view('employee/invoiceEdit', ['newID' => $id ,'serviceorder' => $order]);
        }
}
