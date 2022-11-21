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

//TO DO: ini klo udh login gabisa ke dashboard page / nya malah ke login mesti cek user session
Route::get('/', function () {
    //TO ASK: ini perlu pake controller?? utk ke login pagenya
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//READ
Route::get('admin/searchAsset', [\App\Http\Controllers\AssetController::class, 'index'])->name('searchAsset');
//CREATE
Route::get('admin/createAsset', [\App\Http\Controllers\AssetController::class, 'create'])->name('createAsset');
Route::post('admin/searchAsset', [\App\Http\Controllers\AssetController::class, 'store'])->name('storeAsset');
//UPDATE
Route::get('admin/editAsset/{id}', [\App\Http\Controllers\AssetController::class, 'edit']);
Route::put('updateAsset/{id}', [\App\Http\Controllers\AssetController::class, 'update']);
//DELETE
Route::delete('deleteAsset/{id}', [\App\Http\Controllers\AssetController::class, 'destroy']);
//DOWNLOAD XLSX
Route::get('export', [\App\Http\Controllers\AssetExportController::class, 'export'])->name('downloadAsset');
