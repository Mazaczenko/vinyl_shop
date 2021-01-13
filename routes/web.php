<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/', 'vinylHome');

Route::view('contact-us', 'contact');

Route::view('vinylHome', 'vinylHome');

Route::get('admin/records', function (){
    
    $records = [
        'Queen - Greatest Hits',
        'The Rolling Stones - Sticky Fingers',
        'The Beatles - Abbey Road'
    ];

    return view('admin.records.index', [
        'records' => $records
    ]);

    return view('admin.records.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
