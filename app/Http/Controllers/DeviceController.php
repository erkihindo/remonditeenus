<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DeviceController extends Controller
{
    public function index()
    {
        return view('employee/devices');
    }
}
