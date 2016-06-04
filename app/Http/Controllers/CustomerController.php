<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Customer;
class CustomerController extends Controller
{
    public function getAll() {
        $customers = Customer::get();
        $userList = [];
        foreach ($customers as $customer) {
            array_push($userList,  $customer->user->name);
        }
        return response()->json($userList,200);
    }
    
}
