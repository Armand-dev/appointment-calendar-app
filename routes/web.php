<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/appointment', AppointmentController::class);
Route::get('/getAvailableTimeSlots/{date}', [AppointmentController::class, 'getAvailableTimeSlots']);

Route::middleware(['auth'])->group(callback: function (){
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/event', [PageController::class, 'event'])->name('event');

    Route::get('/appointment/{appointment_id}/markAsDone', [AppointmentController::class, 'markAsDone']);
    Route::get('/appointment/{appointment_id}/delete', [AppointmentController::class, 'destroy']);

});
require __DIR__.'/auth.php';
