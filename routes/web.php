<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PageController;
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
Route::get('admin/customer',[CustomerController::class,'index']);
Route::post('admin/customer-save',[CustomerController::class,'save']);
Route::get('admin/customer-edit/{id}',[CustomerController::class,'edit']);
Route::post('admin/customer-update',[CustomerController::class,'update']);
Route::get('admin/customer-delete/{id}',[CustomerController::class,'delete']);


Route::get('admin/products',[ProductsController::class,'index']);
Route::post('admin/products-save',[ProductsController::class,'save']);
Route::get('admin/products-edit/{id}',[ProductsController::class,'edit']);
Route::post('admin/products-update',[ProductsController::class,'update']);
Route::get('admin/products-delete/{id}',[ProductsController::class,'delete']);

Route::get('/product-details/{id}',[ProductsController::class,'single_index']);
// Route::get('/product-details/{id}',[ProductsController::class,'recent_product']);
// Route::get('user/products-viewcms/{id}',[ProductsController::class,'viewcms']);
//frontend products
Route::get('home',[ProductsController::class,'view']);
Route::get('/',[ProductsController::class,'view']);

Route::get('admin/products/{id}', [ProductsController::class, 'show'])->name('user.show');
Route::get('admin/pages/{id}', [PageController::class, 'show'])->name('pages.show');
Route::get('admin/customers/{id}', [CustomerController::class, 'show'])->name('customers.show');

Route::get('admin/pages',[PageController::class,'index']);
Route::post('admin/pages-save',[PageController::class,'save']);
Route::get('admin/pages-edit/{id}',[PageController::class,'edit']);
Route::post('admin/pages-update',[PageController::class,'update']);
Route::get('admin/pages-delete/{id}',[PageController::class,'delete']);
Route::get('about-us',[PageController::class,'aboutus']);
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
