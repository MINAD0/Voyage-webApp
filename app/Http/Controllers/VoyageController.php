<?php

namespace App\Http\Controllers;

use App\Models\DateDisponibility;
use App\Models\Voyage;
use App\Models\Hotel;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class VoyageController extends Controller
{

    public function index(){
        $voyages = Voyage::latest()->paginate(8);
        return view('index')->with('voyages', $voyages);
    }

    public function national_voyages(){
        $voyages = Voyage::where('type', 0)
            ->latest()
            ->paginate(6);

        return view('Voyage.Maroc_Voyages')->with('voyages', $voyages);
    }
    public function international_voyages(){
        $voyages = Voyage::where('type', 1)
            ->latest()
            ->paginate(6);

        return view('Voyage.Inter_Voyages')->with('voyages', $voyages);
    }

    public function voyage_result(){
        $voyages = Voyage::latest()->paginate(8);
        $hotels = Hotel::all();
        return view('Voyage.Voyage_result')->with('voyages', $voyages);
    }

    public function searchVoyage(Request $request)
    {
        $depart = $request->input('depart');
        $arrive = $request->input('arrive');
        $date = $request->input('datefilter');
        $adult = $request->input('adult');
        $enfant = $request->input('enfant');
        list($start_date, $end_date) = explode(' - ', $date);

        $start_date = DateTime::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
        $end_date = DateTime::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');

        $voyagesresults = Voyage::where(['Depart'=> $depart ,'Arrive'=> $arrive ])->whereHas('dateDisponibility', function($q) use($start_date,$end_date){
            $q->where('date_debut' , '>=', $start_date)->where('date_fin' , '<=', $end_date);
        })->get();

        return view('Voyage.Voyage_result', compact('voyagesresults'));
    }

    public function VoyageFilter(Request $request){

            $villeDepart = $request->input('villeDepart');
            $villeArrive = $request->input('villeArrive');
            $range = $request->input('range');
            $type = $request->input('type');
            $prices = Voyage::pluck('prix')->toArray();

            $minPrice = min($prices);

            $voyagesresults = Voyage::where(['type' => $type, 'Depart' => $villeDepart, 'Arrive' => $villeArrive])
            ->orWhereBetween('prix', [$minPrice,$range])
            ->whereHas('dateDisponibility')
            ->get();

            // dd($voyagesresults);

            return view('Voyage.Voyage_result', compact('voyagesresults'));


    }

    public function VoyageDetail(Voyage $id,Request $request){
        $voyagesId = $request->input('voyageId');
        // dd($voyagesId);
        // DB::connection()->enableQueryLog();
        $dateDisponibilities = DateDisponibility::where('voyage_id' , $voyagesId)->get();
        // dd($dateDisponibilities);
        // $sql = DB::getQueryLog();;
        // dd($sql);
        return view('Voyage.Voyage_details', ['voyages' => $id , 'dateDisponibilities' => $dateDisponibilities]);
    }

}
