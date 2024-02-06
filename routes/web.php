<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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

Route::get('/', function () {
    return view('listings', [
        'heading' => 'List of Listings',
        'listings' => Listing::all() /*[
            /*[
                'id' => '1',
                'title' => 'Listing One',
                'description' => 'WAZZZZZZZZZZZZZZZZUP'
            ],
            [
                'id' => '2',
                'title' => 'Listing Two',
                'description' => 'WAZZZZZZZZZZZZZZZZUUUUUUUUUUUUUUUUUUUUUUUUUP'
            ]*/
    ]);
});

/*Route::get('singleListing/{id}', function($id) {
    return view('singleListing', [
        'listings' => Listing::find($id)
    ]);

});*/

Route::get('singleListing/{listing}', function(Listing $listing){
    return view('singleListing', [
        'listings' => $listing
    ]);
});

Route::get('hello', function () {
    return response('<h1>Hello World</h1>');
});

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