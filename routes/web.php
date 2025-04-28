<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/health', [\App\Http\Controllers\HealthCheckController::class, 'index']);
Route::domain('vikas.meetmytech.com')->group(function () {
    Route::get('/vikas', [\App\Http\Controllers\VikasProfileController::class, 'homePage']);
});
Route::get('/vikas-profile', [\App\Http\Controllers\VikasProfileController::class, 'homePage']);
