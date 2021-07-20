<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogtestController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

Route::get('/blogpost', [BlogtestController::class, 'index'])->name('blogpost');

Route::get('/create', [BlogtestController::class, 'create'])->name('postcreate');

Route::post('/store', [BlogtestController::class, 'store'])->name('blogtest.store');

Route::get('/show/{id}', [BlogtestController::class, 'show'])->name('show');

Route::get('/edit/{id}', [BlogtestController::class, 'edit'])->name('edit');

Route::put('/update/{id}', [BlogtestController::class, 'update'])->name('blogtest.update');

Route::delete('/deletepost/{id}', [BlogtestController::class, 'destroy'])->name('deletepost');


