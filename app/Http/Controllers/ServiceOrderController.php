<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service_order;

class ServiceOrderController extends Controller
{
    public function index()
    {
        $maxID = Service_order::max('id');
        $newID = $maxID +1;
        
        return view('employee/serviceorder', ['newID' => $newID]);
    }
}
