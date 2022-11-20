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

Route::get('/', function () {
    //TO ASK: ini perlu pake controller?? utk ke login pagenya
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('admin/searchAsset', [\App\Http\Controllers\AssetController::class, 'index'])->name('searchAsset');
Route::get('admin/createAsset', [\App\Http\Controllers\AssetController::class, 'create'])->name('createAsset');
Route::post('admin/searchAsset', [\App\Http\Controllers\AssetController::class, 'store'])->name('storeAsset');
