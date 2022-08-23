<?php

use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganiserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

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

Route::get('/events', [PagesController::class, 'events'])->name('events');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('pages.contact');
Route::get('/about', function () {
    return view('pages.about');
})->name('pages.about');
Route::post('/contact', [ContactController::class, 'contactFormSent'])->middleware(ProtectAgainstSpam::class)->name('contact-form-sent');

Route::get('/organiser-submitted', function () {
    return view('organiser.submitted');
})->name('organiser.submitted');

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin'], function () {
    Route::get('dashboard', [PagesController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('dashboard/organisers', [OrganiserController::class, 'adminIndex'])->name('admin.organisers');
    Route::get('dashboard/organiser/docs/{organiser}', [OrganiserController::class, 'adminDocs'])->name('admin.organiser.docs');
    Route::get('event/{id}', [EventController::class, 'showAdmin'])->name('admin.event.show');
    Route::get('event/approval/{id}', [EventController::class, 'adminApproval'])->name('admin.event.approve');
    Route::get('event/unpublish/{id}', [EventController::class, 'adminUnpublish'])->name('admin.event.unpublish');
    Route::get('resend-activation/{organiser}', [OrganiserController::class, 'resendActivation'])->name('admin.resend-activation');
});

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'venue'], function () {
    Route::get('edit/{venue}', [VenueController::class, 'edit'])->name('venue.edit');
    Route::match(['put', 'patch'], 'update/{venue}', [VenueController::class, 'update'])->name('venue.update');
    Route::delete('delete/{venue}', [VenueController::class, 'destroy'])->name('venue.delete');
});

Route::group(['middleware' => ['auth', 'role:organiser', 'disabled'], 'prefix' => 'dashboard'], function () {
    Route::get('/index', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/document-hide-cookie', [UserController::class, 'documentsHide'])->name('dashboard.documents.hide');
    Route::get('/documents', [DocumentController::class, 'index'])->name('dashboard.documents');
});

Route::resource('organiser', OrganiserController::class);
Route::resource('document', DocumentController::class)->middleware('auth');
Route::post('event-save-draft', [EventController::class, 'saveDraft'])->name('event.save-draft')->middleware('auth');
Route::patch('event-update-and-submit', [EventController::class, 'updateAndSubmit'])->name('event.update-and-submit')->middleware('auth');
Route::get('event-cancel/{id}', [EventController::class, 'cancel'])->name('event.cancel')->middleware('auth');
Route::get('fest-event/{slug}', [EventController::class, 'showBySlug'])->name('event.show-by-slug');
Route::get('event-preview/{slug}', [EventController::class, 'preview'])->middleware('auth')->name('event.preview');
Route::resource('event', EventController::class)->middleware('auth');
Route::resource('attendee', AttendeeController::class);

Route::get('approved/organiser/{organiser}', [OrganiserController::class, 'approved'])->name('approved.organiser');
Route::get('disabled/organiser/{organiser}', [OrganiserController::class, 'disabled'])->name('approved.disabled');
Route::get('activate', [UserController::class, 'activate'])->name('account.activate');

Route::post('/register-admin', [RegisteredUserController::class, 'storeAdmin'])->name('register.admin');

require __DIR__.'/auth.php';
