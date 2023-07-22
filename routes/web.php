<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::resource('/users', UserController::class);
Route::resource('/vendors', VendorController::class);
Route::resource('/brands', BrandController::class);



Route::view('master','cms.master')->name('master');


// Route::get('{guard}/login' , [UserAuthController::class , 'showLogin'])->name('view.login');

Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');


Route::get('/register', [UserAuthController::class, 'register'])->name('register');
Route::post('/register', [UserAuthController::class, 'registerPost'])->name('register');


Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])
->name('view.login')
->middleware('is_admin');