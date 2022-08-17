<?php

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(callback: function (){
    Route::get('/event', function (){
        return view('event');
    })->name('event');

    Route::get('/scheduled-events', function (){
        return view('scheduled_events');
    })->name('scheduled-events');
});
require __DIR__.'/auth.php';
