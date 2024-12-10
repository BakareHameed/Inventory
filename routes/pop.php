<?php

use App\Http\Controllers\ServiceOps\POPController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Custom POP Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'pop'], function () {
    Route::post('/routine/check/report', [POPController::class, 'routineCheckReport'])->name('pop.routine.report');
  
  });