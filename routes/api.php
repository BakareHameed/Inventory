<?php

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Client;
use App\Http\Controllers\Inventory\Supplier;
use Illuminate\Support\Facades\Route;
use App\Models\Support\ProactiveReport;

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

Route::prefix('api')->group(function () {
    Route::get('suppliers', [Supplier::class, 'index']);
    Route::get('suppliers/{id}', [Supplier::class, 'show']);
    Route::post('suppliers', [Supplier::class, 'store']);
    Route::put('suppliers/{id}', [Supplier::class, 'update']);
    Route::delete('suppliers/{id}', [Supplier::class, 'destroy']);
});

