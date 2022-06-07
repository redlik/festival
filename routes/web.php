<?php

use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganiserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
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

Route::get('/', [PagesController::class, 'home'])->name('home');

Route::get('/join-us', function () {
    return view('pages.registration');
})->name('pages.join-us');

Route::get('/organiser-submitted', function () {
    return view('organiser.submitted');
})->name('organiser.submitted');

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

Route::resource('organiser', OrganiserController::class);
Route::resource('event', EventController::class);
Route::resource('attendee', AttendeeController::class);

Route::get('approved/organiser/{organiser}', [OrganiserController::class, 'approved'])->name('approved.organiser');
Route::get('disabled/organiser/{organiser}', [OrganiserController::class, 'disabled'])->name('approved.disabled');
Route::get('activate', [UserController::class, 'activate'])->name('account.activate');

require __DIR__.'/auth.php';
