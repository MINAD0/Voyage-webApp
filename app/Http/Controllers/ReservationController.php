<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //

    public function index(Voyage $id){
        // dd('ok');
        return view('content.paiment',['voyage'=> $id]);
    }
    
}
