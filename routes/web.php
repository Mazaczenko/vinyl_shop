<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RecordController;
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
Route::view('contact-us', 'contact');
Route::view('vinylHome', 'vinylHome');

// New version with prefix and group
Route::prefix('admin')->group(function () {

    Route::redirect('/', 'records');
    Route::get('records',[RecordController::class, 'index']);
});

// Routs for authorized users
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
