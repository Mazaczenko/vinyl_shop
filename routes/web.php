<?php

use Illuminate\Support\Facades\{Auth, Route};
use App\Http\Controllers\{ShopController, ItunesControlle, BasketController, ContactUsController};
use App\Http\Controllers\Admin\{UserController, OrderController, GenresController, RecordController};
use App\Http\Controllers\User\{HistoryController, ProfileController, PasswordController};
use App\Http\Controllers\Auth\LoginController;

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

// Basic views
Route::get('contact-us', [ContactUsController::class, 'show']);
Route::post('contact-us', [ContactUsController::class, 'sendEmail']);
Route::get('itunes', [ItunesControlle::class, 'index']);
Route::get('shop', [ShopController::class, 'index']);
Route::get('shop/{id}', [ShopController::class, 'show']);

// Basket views
Route::get('basket', [BasketController::class, 'index']);
Route::get('basket/add/{id}', [BasketController::class, 'addToCart']);
Route::get('basket/delete/{id}', [BasketController::class, 'deleteFromCart']);
Route::get('basket/remove/{id}', [BasketController::class, 'removeRecordFromCart']);
Route::get('basket/empty', [BasketController::class, 'emptyCart']);

// New version with prefix and group
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::redirect('/', '/admin/records');
    Route::get('genres/qryGenres', [GenresController::class, 'qryGenres']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::resource('genres', GenresController::class);
    Route::resource('records', RecordController::class);
    Route::resource('users', UserController::class);

    // yes, you can nest prefixes and groups if you want :-)
    Route::prefix('demo')->group(function (){
        Route::get('orderlines', [OrderController::class, 'orderlines']);
        Route::get('users', [OrderController::class, 'users']);
    });
});

// Routs for authorized users
Auth::routes();
    Route::get('logout', [LoginController::class, 'logout']);
    Route::redirect('home', '/');
    Route::view('/', 'home');

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::redirect('/', '/user/profile');
    Route::get('profile', [ProfileController::class, 'edit']);
    Route::post('profile', [ProfileController::class, 'update']);
    Route::get('password', [PasswordController::class, 'edit']);
    Route::post('password', [PasswordController::class, 'update']);
    Route::get('history', [HistoryController::class, 'index']);
    Route::get('checkout', [HistoryController::class, 'checkout']);
});
