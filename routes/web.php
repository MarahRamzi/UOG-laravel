<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ResetPasswordController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resources([
    'users' => UserController::class,
    'vendors' => VendorController::class,
    'brands' => BrandController::class,
    'items' => ItemController::class,
    'countries' => CountryController::class,
    'cities' => CityController::class,
    'inventories' =>InventoryController::class,

], [
    'middleware' => ['auth']
]);


Route::view('master','cms.master')->name('master');

Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

Route::get('/register', [UserAuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [UserAuthController::class, 'registerPost'])->name('register');

Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [UserAuthController::class, 'login'])
->name('view.login');

// Route::get('/items/filter', [ItemController::class, 'filterItems']);

Route::get('cart', [ItemController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ItemController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ItemController::class, 'updateCart'])->name('update.cart');
Route::delete('remove-from-cart', [ItemController::class, 'remove'])->name('remove.from.cart');

Route::get('/items/{item}/largest-quantity', [ItemController::class, 'Largestquantity'])
    ->name('inventory.largest-quantity');

Route::get('/test-low-quantity', [PurchaseController::class, 'makePurchase'])->name('test_quantity');
Route::put('/inventory/{inventory}', [InventoryController::class , 'updateInventory'])->name('inventory.update');



// Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
// Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/forgot-password', [ResetPasswordController::class , 'indexlink'])->middleware('auth')->name('password.request');
Route::post('/forgot-password', [ResetPasswordController::class , 'sendlink'])->middleware('auth')->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class , 'indexreset'])->middleware('auth')->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class , 'resetPassword'])->middleware('auth')->name('password.update');