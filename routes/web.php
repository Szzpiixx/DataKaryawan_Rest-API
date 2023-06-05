<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;


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

Route::get('/', [KaryawanController::class, 'createToken']);
Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::post('/karyawan/store', [KaryawanController::class, 'store']);
Route::get('/karyawan/{id}', [KaryawanController::class, 'show']);
Route::put('/karyawan/update/{id}', [KaryawanController::class, 'update']);
Route::delete('/karyawan/delete/{id}', [KaryawanController::class, 'destroy']);



