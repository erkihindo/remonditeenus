<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class DevicePartsController extends Controller
{
    public function index()
    {
        dd("TODO");
    }
    
    public function addPart() {
        return view('employee/addpart');
    }
}
