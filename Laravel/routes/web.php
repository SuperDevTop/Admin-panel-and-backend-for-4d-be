<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('login');
});

Route::post('/login', [UserController::class, 'login']);
Route::get('/dashboard', function(){
    return view('dashboard');
});
Route::get('/pointsmovement', function(){
    return view('pointsmovement');
});
Route::get('/activities', function(){
    return view('activities');
});
Route::get('/excessamount', function(){
    return view('excessamount');
});

