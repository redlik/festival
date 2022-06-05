<?php

use App\Http\Controllers\OrganiserController;
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
    return view('pages.home');
});

Route::get('/join-us', function () {
    return view('pages.registration');
})->name('pages.join-us');

Route::get('/organiser-submitted', function () {
    return view('organiser.submitted');
})->name('organiser.submitted');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('organiser', OrganiserController::class);

require __DIR__.'/auth.php';
