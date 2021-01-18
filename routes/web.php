<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RecordController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ItunesControlle;
use App\Http\Controllers\ShopController;


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
Route::view('/', 'vinylHome');

Route::view('vinylHome', 'vinylHome');

Route::get('contact-us', [ContactUsController::class, 'show']);

Route::post('contact-us', [ContactUsController::class, 'sendEmail']);

Route::get('itunes', [ItunesControlle::class, 'index']);

Route::get('shop', [ShopController::class, 'index']);

Route::get('shop/{id}', [ShopController::class, 'show']);

// New version with prefix and group
Route::prefix('admin')->group(function () {

    Route::redirect('/', 'records');
    Route::get('records',[RecordController::class, 'index']);
});

// Routs for authorized users
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
