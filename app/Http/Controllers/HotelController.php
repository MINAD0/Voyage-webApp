<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Voyage;
use DateTime;
use Illuminate\Http\Request;

class HotelController extends Controller
{


    public function national_hotels(){
        $national_hotels = Hotel::where('type','=','national')->latest()->paginate(6);
        return view('Hotel.national_hotel')->with('national_hotels', $national_hotels);
    }

    public function international_hotels(){
        $international_hotels = Hotel::where('type','=','international')->latest()->paginate(6);
        return view('Hotel.international_hotel')->with('international_hotels', $international_hotels);
    }

    public function hotel_result(){
        $hotels = Hotel::all();
        return view('Hotel.Hotel_result')->with('hotels', $hotels);
    }

    public function searchHotel(Request $request){

        // dd($request->all());
        $ville = $request->input('ville');
        $date = $request->input('datefilter');
        $adult = $request->input('adult');
        $enfant = $request->input('enfant');


        list($start_date, $end_date) = explode(' - ', $date);

        $start_date = DateTime::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
        $end_date = DateTime::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');

        $hotelsresults = Hotel::where('ville_id', $ville)->whereHas('dateDisponibility', function($q) use($start_date,$end_date){
            $q->where('date_debut' , '>=', $start_date)
            ->where('date_fin' , '<=', $end_date);
        })->get();

        // dd($hotelsresults);

        return view('Hotel.Hotel_result', compact('hotelsresults'));

    }

    public function HotelFilter(Request $request){

        // dd($request->all());
        $hotel = $request->input('hotel');
        $range = $request->input('range');
        // $type = $request->input('type');
        $ville = $request->input('ville');
        $prices = Voyage::pluck('prix')->toArray();

        $minPrice = min($prices);

        $hotelsresults = Hotel::where('nom_hotel', $hotel)
        ->whereHas('ville', function($q) use($ville){
            $q->where('ville_id', $ville);
        })
        ->whereHas('dateDisponibility')
        ->get();

        // dd($hotelsresults);
        return view('Hotel.Hotel_result', compact('hotelsresults'));

    }

}
