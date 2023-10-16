<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarbonIntensity;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/intensity', [CarbonIntensity::class,'intensity']);
Route::get('/regionlist', [CarbonIntensity::class,'regionlist']);

Route::get('/region/{regionid}', [CarbonIntensity::class,'byregion']);

Route::get('/energy', [CarbonIntensity::class,'byenergy']);

Route::get('/england', [CarbonIntensity::class,'england']);
Route::get('/scotland', [CarbonIntensity::class,'scotland']);

Route::get('/wales', [CarbonIntensity::class,'wales']);

Route::get('/average/{from}/{to}', [CarbonIntensity::class,'average']);