<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Device;

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
    public function createDevice(Request $request) {
        $newDevice = new Device();
        $newDevice->name = $request->name;
        $newDevice->model = $request->model;
        $newDevice->reg_no = $request->serial_nr;
        $newDevice->description = $request->description;
        $newDevice->manufacturer = $request->manufacturer;
        if($newDevice->save()) {
            dd('saved new device');
        }
    }
}
