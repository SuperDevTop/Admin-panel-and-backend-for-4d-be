<?php

use App\Http\Controllers\BeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup', [RegisterController::class, 'customerSignup']);
Route::post('/login', [LoginController::class, 'customerLogin']);
Route::post('/bet', [BeController::class, 'bet']);
Route::post('/getBetHistory', [BeController::class, 'betHistory']);
Route::post('/getTicket', [BeController::class, 'ticket']);
// Route::get('/getRankNumbers', [BeController::class, 'rankNumbers']);
Route::post('/getRankNumbers', [BeController::class, 'rankNumbers']);
Route::get('/getTime', [BeController::class, 'getTime']);
Route::post('/getPointBalance', [BeController::class, 'getPointBalance']);

Route::post('/movePoint', [BeController::class, 'movePoint']);
