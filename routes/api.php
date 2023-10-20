<?php

use App\Http\Controllers\DatapaketController;
use App\Http\Controllers\DetailpaketController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\DetailproController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loadedcaridata by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
  'middleware' => 'api',
  'prefix' => 'auth'

], function ($router) {
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/register', [AuthController::class, 'register']);
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::post('/refresh', [AuthController::class, 'refresh']);
  Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});
Route::get('datapakets/getall', [DatapaketController::class, 'getall']);
Route::post('datapakets/getall', [DatapaketController::class, 'cari']);
Route::get('datapakets/getstatic', [DatapaketController::class, 'getStatistic']);
Route::get('datapakets/getdata', [DatapaketController::class, 'getData']);
Route::get('datapakets/getdatametode', [DatapaketController::class, 'getdatametode']);
Route::get('datapakets/getswakelola', [DatapaketController::class, 'getSwakelola']);
Route::get('datapakets/getpengadaanlangsung', [DatapaketController::class, 'getPengadanLangsung']);
Route::get('datapakets/getpuchas', [DatapaketController::class, 'getPurchas']);
Route::get('datapakets/getpl', [DatapaketController::class, 'getPl']);
Route::get('datapakets/getkecuali', [DatapaketController::class, 'getKecuali']);
Route::get('datapakets/getender', [DatapaketController::class, 'getTender']);
Route::get('datapakets/getseleksi', [DatapaketController::class, 'getSeleksi']);

Route::post('datapakets/datakontrak', [DatapaketController::class, 'SimpanDatakontrak']);

Route::delete('datapakets/hapuskontrak', [DatapaketController::class, 'HapusDataKontrak']);


Route::post('datapakets/postdata', [DetailproController::class, 'SimpanData']);

Route::post('datapakets/postdatas',[DetailproController::class,'HapusData']);

Route::delete('datapakets/postdatas',[DetailproController::class,'delete']);

//Detail controller

Route::get('datapakets/getkoderup', [DetailpaketController::class, 'getData']);
Route::get('datapakets/detailpemenang', [DetailpaketController::class, 'getDetailPemenang']);

Route::get('datapakets/penyedia', [PenyediaController::class, 'getallpenyedia']);
Route::get('datapakets/getpenyedia', [PenyediaController::class, 'getJoinPenyedia']);
Route::get('datapakets/getwinpro', [PenyediaController::class, 'getDetailpaketWin']);
Route::post('datapakets/penyedia', [PenyediaController::class, 'SimpanPenyedia']);
Route::delete('datapakets/penyedia',[PenyediaController::class,'hapusPenyedia']);


Route::get('datapakets/getdetaildata', [MonitoringController::class, 'getDataDetail']);
Route::post('datapakets/simpanmonitor', [MonitoringController::class, 'SimpanDataMonitor']);
Route::delete('datapakets/delemonitoring',[MonitoringController::class,'HapusDataMonitor']);

Route::get('datapakets/getdatamonitor', [MonitoringController::class, 'getDataAllMonitor']);
  //
//
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
