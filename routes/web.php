<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});
//admin

//Route::group(['prefix'=>'admin','middleware'=>['auth','admin']], function(){
//
//    Route::post('toggledeliver/{orderId}','OrderController@toggledeliver')->name('toggle.deliver');
//
//    Route::post('toggledeliver/{productId}','ProductsController@toggledeliver')->name('product.deliver');
//
//
//    Route::get('/',function(){
//        return view('admin.index');
//    })->name('admin.index');
//});


Route::middleware('admin:admin')->group(function(){
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');
});
Route::middleware(['auth:sanctum,admin',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
//User
Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
