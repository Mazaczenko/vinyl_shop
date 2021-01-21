<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ItunesControlle;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\GenresController;
use App\Http\Controllers\Admin\RecordController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\Genres2Controller;
use App\Http\Controllers\User\PasswordController;

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

// New version with prefix and group
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function ()
{
    Route::redirect('/', '/admin/records');
    Route::resource('genres', GenresController::class);
    Route::get('genres2/qryGenres', [Genres2Controller::class, 'qryGenres']);
    Route::resource('genres2', Genres2Controller::class)->parameters([
        'genres2' => 'genres'
    ]);
    Route::get('records',[RecordController::class, 'index']);
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
});
