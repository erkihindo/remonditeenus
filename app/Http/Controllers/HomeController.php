<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Customer;

class HomeController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $user = Auth::user();
        if($user->employee != null) {
            
            return redirect()-> route('servicerequest');
        } else if($user->customer != null)  {
            dd("Customer TODO view");
            
        }
            
         else   {
            
            dd("Who the hell are you");
        }
    }
}
