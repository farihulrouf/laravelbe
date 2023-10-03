<?php
use App\Http\Controllers\DatapaketController;
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
Route::get('datapakets/getall',[DatapaketController::class, 'getall']);
Route::post('datapakets/getall',[DatapaketController::class, 'cari']);
Route::get('datapakets/getstatic',[DatapaketController::class, 'getStatistic']);


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/



