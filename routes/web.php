<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */ 
//ALL LISTING
Route::get('/', [ListingController::class, 'index']);//function () {
    /*return view('listings', [
        'listings' => Listing::all() /*[
            [
                'id' => '1',
                'title' => 'Listing One',
                'description' => 'WAZZZZZZZZZZZZZZZZUP'
            ],
            [
                'id' => '2',
                'title' => 'Listing Two',
                'description' => 'WAZZZZZZZZZZZZZZZZUUUUUUUUUUUUUUUUUUUUUUUUUP'
            ]
    ]);*/
//});

/*Route::get('singleListing/{id}', function($id) {
    return view('singleListing', [
        'listings' => Listing::find($id)
    ]);

});*/
//SINGLE LISTING
Route::get('singleListing/{listing}', [ListingController::class,  'show']);//We just moved the functionality in a controller. So before ->//function(Listing $listing){
    /*return view('singleListing', [
        'listings' => $listing
    ]);*/ // I made a controller for the home page and singleListing
//});
//Create Form
Route::get('/listings/create', [ListingController::class,  'create'])->middleware('auth');

//Store listing Data
Route::post('/listings', [ListingController::class,  'store'])->middleware('auth');

//SHOW EDIT FORM
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

Route::get('hello', function () {
    return response('<h1>Hello World</h1>');
});

//Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//Show Registration Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Create New User
Route::post('/users', [UserController::class, 'store']);

//Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Login User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');



Route::get('posts/{id}', function($id){
    return response('Posts ' . $id); //response is a helper method
})->where('id', '[0-9]+'); //costraints per poter ricevere solo numeri interi

Route::get('posts1/{id}', function($id){
    ddd($id); //die dump debug helper method, will stop everything and show what parameter i passed, debugging
    return response('Posts ' . $id); //response is a helper method
})->where('id', '[0-9]+'); //costraints per poter ricevere solo numeri interi


Route::get('search', function (Request $request) {
    //dd($request); //fa vedere una serie di robe
    //dd($request->name . ' ' . $request->city);
    return ($request->name . ' ' . $request->city);
});