<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DataAsistenController;
use App\Http\Controllers\Backend\DataKelasController;
use App\Http\Controllers\Backend\DataMateriController;
use App\Http\Controllers\Backend\KodeGeneratorController;
use App\Http\Controllers\Backend\AbsensiController;
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
    return view('auth.login');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout1');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(DataAsistenController::class)->group(function (){
    Route::get('/dataass/index', 'index')->name('indexDataAss');
    Route::get('/dataass/create', 'create')->name('createDataAss');
    Route::get('/dataass/edit/{id}', 'edit')->name('editDataAss');
    Route::post('/dataass/post', 'store')->name('storeDataAss');
    Route::put('/dataass/update/{id}', 'update')->name('updateDataAss');
    Route::delete('/dataass/delete/{id}', 'destroy')->name('deleteDataAss');
});

Route::controller(DataKelasController::class)->group(function () {
    Route::get('/datakelas', 'index')->name('indexDataKelas');
    Route::get('/datakelas/create', 'create')->name('createDataKelas');
    Route::get('/datakelas/edit/{id}', 'edit')->name('editDataKelas');
    Route::post('/datakelas/post', 'store')->name('storeDataKelas');
    Route::put('/datakelas/update/{id}', 'update')->name('updateDataKelas');
    Route::delete('/datakelas/delete/{id}', 'destroy')->name('deleteDataKelas');

});

Route::controller(DataMateriController::class)->group(function () {
    Route::get('/datamateri', 'index')->name('indexDataMateri');
    Route::get('/datamateri/create', 'create')->name('createDataMateri');
    Route::get('/datamateri/edit/{id}', 'edit')->name('editDataMateri');
    Route::post('/datamateri/post', 'store')->name('storeDataMateri');
    Route::put('/datamateri/update/{id}', 'update')->name('updateDataMateri');
    Route::delete('/datamateri/delete/{id}', 'destroy')->name('deleteDataMateri');
});

Route::controller(KodeGeneratorController::class)->group(function () {
    Route::get('/kodegenerator', 'index')->name('indexKode');
    Route::get('/kodegenerator/generate/modul/{frommodule}', 'store')->name('generateCode');
    Route::get('/kodegenerator/generator/dash/{fromdahsboard}', 'store')->name('generateCodeDash');
});

Route::controller(AbsensiController::class)->group(function(){
    Route::post('/absen/masuk', 'store')->name('storeAbsen');
    Route::get('/absen/keluar', 'update')->name('updateAbsen');
});