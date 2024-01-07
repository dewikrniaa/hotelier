<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::resource('/pelanggan',
\App\Http\Controllers\PelangganController::class);

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    //Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/', 'LoginController@show')->name('login.show');
        Route::post('/', 'LoginController@login')->name('login.perform');
        Route::get('/login', 'LoginController@show')->name('login');
    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/dashboard', 'DashboardController@index')->name('layouts.dashboard');
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});

Route::resource('/kamar',\App\Http\Controllers\KamarController::class);
Route::get('/kamar', [\App\Http\Controllers\KamarController::class, 'index'])->name('kamar.index');
Route::get('/kamar/create', [\App\Http\Controllers\KamarController::class, 'create'])->name('kamar.create');
Route::post('/kamar', [\App\Http\Controllers\KamarController::class, 'store'])->name('kamar.store');
Route::get('/kamar/{id}/edit', [\App\Http\Controllers\KamarController::class, 'edit'])->name('kamar.edit');
Route::put('/kamar/{id}', [\App\Http\Controllers\KamarController::class, 'update'])->name('kamar.update');
Route::delete('/kamar/{id}', [\App\Http\Controllers\KamarController::class, 'destroy'])->name('kamar.destroy');

Route::resource('/reservasi',\App\Http\Controllers\ReservasiController::class);
Route::get('/reservasi', [\App\Http\Controllers\ReservasiController::class, 'index'])->name('reservasi.index');
Route::get('/reservasi/create', [\App\Http\Controllers\ReservasiController::class, 'create'])->name('reservasi.create');
Route::post('/reservasi', [\App\Http\Controllers\ReservasiController::class, 'store'])->name('reservasi.store');
Route::get('/reservasi/{id}/edit', [\App\Http\Controllers\ReservasiController::class, 'edit'])->name('reservasi.edit');
Route::put('/reservasi/{id}', [\App\Http\Controllers\ReservasiController::class, 'update'])->name('reservasi.update');
Route::delete('/reservasi/{id}', [\App\Http\Controllers\ReservasiController::class, 'destroy'])->name('reservasi.destroy');
Route::get('/kamarl/{id}/edit', [\App\Http\Controllers\KamarController::class, 'edit'])->name('kamar.edit');
Route::put('/kamar/{id}', [\App\Http\Controllers\KamarController::class, 'update'])->name('kamar.update');
Route::delete('/kamar/{id}', [\App\Http\Controllers\KamarController::class, 'destroy'])->name('kamar.destroy');

Route::resource('/laporan',\App\Http\Controllers\LaporanController::class);

Route::resource('/checkin',\App\Http\Controllers\CheckinController::class);
Route::get('/checkin', [\App\Http\Controllers\CheckinController::class, 'index'])->name('checkin.index');
Route::get('/checkin/create', [\App\Http\Controllers\CheckinController::class, 'create'])->name('checkin.create');
Route::post('/checkin', [\App\Http\Controllers\CheckinController::class, 'store'])->name('checkin.store');
Route::get('/checkin/{id}/edit', [\App\Http\Controllers\CheckinController::class, 'edit'])->name('checkin.edit');
Route::put('/checkin/{id}', [\App\Http\Controllers\CheckinController::class, 'update'])->name('checkin.update');
Route::delete('/checkin/{id}', [\App\Http\Controllers\CheckinController::class, 'destroy'])->name('checkin.destroy');

Route::resource('/checkout',\App\Http\Controllers\CheckoutController::class);
Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
Route::get('/checkout/create', [\App\Http\Controllers\CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/{id}/edit', [\App\Http\Controllers\CheckoutController::class, 'edit'])->name('checkout.edit');
Route::put('/checkout/{id}', [\App\Http\Controllers\CheckoutController::class, 'update'])->name('checkout.update');
Route::delete('/checkout/{id}', [\App\Http\Controllers\CheckoutController::class, 'destroy'])->name('checkout.destroy');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
