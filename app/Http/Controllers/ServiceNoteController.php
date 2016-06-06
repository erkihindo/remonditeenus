<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use App\Service_note;

class ServiceNoteController extends Controller
{
    public function getNotes($id) {
        
        $notes = Service_note::where('service_order_id', $id)->get();
        
        return view('customer/ordercomment', ['notes' => $notes, 
            'order_id' => $id]);
    }
    
    public function createNote(Request $request) {
        $newComment = new Service_note();
        $newComment->user_id = Auth::user()->id;
        $newComment->service_order_id = $request->order_id;
        $user = Auth::user();
        if($user->employee != null) {
            $newComment->note_author_type = 2;
        } else {
            $newComment->note_author_type = 1;
        }
        $newComment->note = $request->note;
        $newComment->save();
        
        return redirect()->back();
    }
}
