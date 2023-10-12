<?php

use App\Http\Controllers\DatapaketController;
use App\Http\Controllers\DetailpaketController;
use App\Http\Controllers\PenyediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('datapakets/getall', [DatapaketController::class, 'getall']);
Route::post('datapakets/getall', [DatapaketController::class, 'cari']);
Route::get('datapakets/getstatic', [DatapaketController::class, 'getStatistic']);
Route::get('datapakets/getdata', [DatapaketController::class, 'getData']);
Route::get('datapakets/getdatametode', [DatapaketController::class, 'getdatametode']);

//Detail controller

Route::get('datapakets/getkoderup', [DetailpaketController::class, 'getData']);

Route::get('datapakets/penyedia', [PenyediaController::class, 'getallpenyedia']);
Route::get('datapakets/getpenyedia', [PenyediaController::class, 'getJoinPenyedia']);
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
