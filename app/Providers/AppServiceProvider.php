<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Hotel;
use App\Models\Ville;
use App\Models\Voyage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $hotels = Hotel::all();
        $voyages = Voyage::all();
        $villes = Ville::all();
        View::share(['hotels'=> $hotels, 'voyages' => $voyages, 'villes' => $villes]);
    }
}
