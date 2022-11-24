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

// TODO: ini klo udh login gabisa ke dashboard page / nya malah ke login mesti cek user session
Route::get('/', function () {
    //TO ASK: ini perlu pake controller?? utk ke login pagenya
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//REQUEST PEMINJAMAN
//READ
Route::get('dashboard/{p}', [\App\Http\Controllers\RequestController::class, 'index']);

//ASSET
//READ
Route::get('searchAsset/{id}', [\App\Http\Controllers\AssetController::class, 'index']);
//CREATE
Route::get('admin/createAsset', [\App\Http\Controllers\AssetController::class, 'create'])->name('createAsset');
Route::post('admin/searchAsset', [\App\Http\Controllers\AssetController::class, 'store'])->name('storeAsset');
//UPDATE
Route::get('admin/editAsset/{id}', [\App\Http\Controllers\AssetController::class, 'edit']);
Route::put('updateAsset/{id}', [\App\Http\Controllers\AssetController::class, 'update']);
//DELETE
Route::post('deleteAsset', [\App\Http\Controllers\AssetController::class, 'destroy']);
//DOWNLOAD XLSX
Route::get('exportasset', [\App\Http\Controllers\AssetController::class, 'export'])->name('downloadAsset');
Route::get('exportdeletedasset', [\App\Http\Controllers\DeletedAssetController::class, 'export'])->name('downloadDeletedAsset');

//USER
//READ
Route::get('superadmin/home', [\App\Http\Controllers\UserController::class, 'index']);
//UPDATE
Route::get('superadmin/editUser/{id}', [\App\Http\Controllers\UserController::class, 'edit']);
Route::put('updateUser/{id}', [\App\Http\Controllers\UserController::class, 'update']);
//DELETE
Route::post('deleteUser', [\App\Http\Controllers\UserController::class, 'destroy']);

//DIVISION
//CREATE
Route::post('superadmin/division', [\App\Http\Controllers\DivisionController::class, 'store'])->name('storeDivision');
//READ
Route::get('superadmin/division', [\App\Http\Controllers\DivisionController::class, 'index'])->name('readDivision');
//DELETE
Route::delete('deleteDivision/{id}', [\App\Http\Controllers\DivisionController::class, 'destroy']);
