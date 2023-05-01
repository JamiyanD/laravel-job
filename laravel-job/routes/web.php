<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Album

Route::get('/album', [ImageController::class, 'index'])->name('album.index');
Route::get('/album/create', [ImageController::class, 'create'])->name('album.create');
Route::post('/album/create', [ImageController::class, 'store'])->name('album.store');
Route::post('/album/image', [ImageController::class, 'image'])->name('album.image');
Route::get('/album/{id}', [ImageController::class, 'show'])->name('album.show');
Route::post('/album/destroy/{id}', [ImageController::class, 'destroy'])->name('album.destroy');
Route::post('/album/add/image', [ImageController::class, 'albumAddImage'])->name('album.add.image');
