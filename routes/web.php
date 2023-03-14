<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDocumentController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('create','create')->name('register.view');
    Route::post('store','store')->name('register');
    Route::get('login','login')->name('login.view');
    Route::post('login','isValidUser')->name('login');
});

Route::controller(UserController::class)->middleware(['auth'])->group(function(){
    Route::get('logout','logOut')->name('logout');
});

Route::controller(UserDocumentController::class)->middleware('auth')->prefix('userDocument')->group(function(){
    Route::get('index','index')->name('userDocument.index');
    Route::get('create','create')->name('userDocument.create');
    Route::post('store','store')->name('userDocument.store');
    Route::get('edit/{id}','edit')->name('userDocument.edit');
    Route::patch('update/{id}','update')->name('userDocument.update');
    Route::delete('delete/{id}','destroy')->name('userDocument.delete');
});

Route::controller(DocumentController::class)->middleware('auth')->prefix('document')->group(function(){
    Route::get('index','index')->name('document.index');
    Route::get('create','create')->name('document.create');
    Route::post('store','store')->name('document.store');
    Route::get('edit/{id}','edit')->name('document.edit');
    Route::patch('update/{id}','update')->name('document.update');
    Route::delete('delete/{id}','destroy')->name('document.delete');
});

Route::get('home', function () {
    return view('home');
})->name('home');

//Success Message
Route::get("success",function(){
    return view('messages.success');
})->name('success.msg');

//Error Message
Route::get("error",function(){
    return view('messages.error');
})->name('error.msg');