<?php

use App\Http\Controllers\TradeController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix('trades')->group(function () {
    Route::get('', [TradeController::class, 'index']);
    Route::post('', [TradeController::class, 'store']);
    Route::get('{trade}', [TradeController::class, 'show']);
});
