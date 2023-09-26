<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VoyageController;
use App\Models\Voyage;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Links
Route::controller(App\Http\Controllers\AuthController::class)->group( function () {
    Route::get('/login', 'login')->name('auth.login');
    Route::get('/register', 'register')->name('auth.register');
});
Route::post('/login', [AuthController::class, 'connect'])->name('connect');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'compte'])->name('compte');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Voyage Links
Route::controller(App\Http\Controllers\VoyageController::class)->group( function (){
    Route::get('/', 'index')->name('index');
    Route::get('/national-voyages', 'national_voyages')->name('national.voyages');
    Route::get('/international-voyages', 'international_voyages')->name('international.voyages');
    Route::get('/voyage-detail/{id}', 'VoyageDetail')->name('VoyageDetail');
});
Route::post('/voyage-search', [VoyageController::class, 'searchVoyage'])->name('searchVoyage');
Route::post('/voyage-filter', [VoyageController::class , 'VoyageFilter'])->name('VoyageFilter');



// Hotel Links
Route::get('/national-hotels', [HotelController::class , 'national_hotels'])->name('national.hotels');
Route::get('/international-hotels', [HotelController::class , 'international_hotels'])->name('international.hotels');
Route::post('/hotel-search', [HotelController::class, 'searchHotel'])->name('searchHotel');
Route::post('/hotel-filter', [HotelController::class , 'HotelFilter'])->name('HotelFilter');



// Profile Links
Route::get('/profile', [ProfileController::class , 'profile'])->name('profile');
//pots
Route::post('/upload-avatar', [ProfileController::class, 'uploadAvatar'])->name('uploadAvatar');
Route::post('/change-profile', [ProfileController::class, 'change_profile'])->name('change_profile');
Route::post('/change-password', [ProfileController::class, 'change_password'])->name('change_password');


//Réservation
Route::get('/paiment/{id}', [ReservationController::class, 'index'])->name('paiment');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/Voyage-maroc', function () {
    return view('Voyage.Maroc_Voyages');
});


