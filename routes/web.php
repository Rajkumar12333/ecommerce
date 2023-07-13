<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\CustomerController;

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
    App::setlocale('en');
    return view('home');
});

// Route::get('/{lang}', function ($lang) {
//     App::setlocale($lang);
//     return view('home');
// });

//routing using resource
Route::resource('tests','TestController');

//routing using components
// Route::get('test', function () {
//     return view('components.first');
// });

//Routing using controller

Route::get("electronics",[FirstController::class,'first']);
Route::get('user/customer',[CustomerController::class,'index']);
Route::post('user/customer-save',[CustomerController::class,'save']);
Route::get('user/customer-edit/{id}',[CustomerController::class,'edit']);
Route::post('user/customer-update',[CustomerController::class,'update']);
Route::get('user/customer-delete/{id}',[CustomerController::class,'delete']);
//Normal routing 
//---------------

// Route::view("home","home");

// Route::view('electronics','electronics');


//example for Regular Expression Constraints routing  
//---------------------------------------------------
// Route::get('/user/{name}', function (string $name) {
//     // ...
// })->where('name', '[A-Za-z]+');
 
// Route::get('/user/{id}', function (string $id) {
//     // ...
// })->where('id', '[0-9]+');
 
// Route::get('/user/{id}/{name}', function (string $id, string $name) {
//     // ...
// })->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::middleware(['CheckUser'])->group(function () {
Route::get('user', function () {
    return Auth::id();
   
});
// Route::get('/user/profile', function () {
//     return Auth::id();
// });
// Route::get('/dashboard', function () {
//     return Auth::id();
// });
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
