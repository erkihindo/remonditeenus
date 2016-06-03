<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DeviceController extends Controller
{
    public function alldevices()
    {
        return view('employee/devices');
    }
    
    public function adddevice()
    {
        return view('employee/adddevice');
    }
}
