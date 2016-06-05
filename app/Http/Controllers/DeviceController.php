<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Device;
use App\Device_type;

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
        $newDevice->device_type_id = $request->type;
        
        if($newDevice->save()) {
            dd('saved new device');
        }
    }
    
    public function getTypes() {
        
        $rootTypes = Device_type::where('level', 0)->get();
        $rootTypes = $rootTypes->toArray();
        for($i = 0; $i < sizeof($rootTypes); $i++) {
            
            $childTypes = Device_type::where('super_type_id', $rootTypes[$i]['id'])->get();
            
            if($childTypes != null) {
                $childTypes = $childTypes->toArray();      
                array_splice( $rootTypes, $i+1, 0, $childTypes );
            }
        }
        $orderedTypes = [];
        foreach($rootTypes as $type) {
            $points = str_repeat('...', intval($type['level']));
            array_push($orderedTypes, array($type['id'], $points . $type['type_name']));
        }
        
        return response()->json($orderedTypes,200);
    }
    
    public function searchForDevices(Request $request) {
        $search = Device::where('name', 'LIKE', "%$request->device_name%")
                ->where('reg_no', 'LIKE', "%$request->serial_nr%")
                ->where('model', 'LIKE', "%$request->model%")
                ->where('manufacturer', 'LIKE', "%$request->manufacturer%")
                ->where('device_type_id', $request->device_type)
                ->get();
        return response()->json($search,200);
    }
}
