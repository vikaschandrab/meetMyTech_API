<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActivitiesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperianceController;
use App\Http\Controllers\ProfileController;

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

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', [\App\Http\Controllers\HealthCheckController::class, 'index']);
Route::domain('vikas.meetmytech.com')->group(function () {
    Route::get('/vikas', [\App\Http\Controllers\VikasProfileController::class, 'homePage']);
});
Route::get('/vikas-profile', [\App\Http\Controllers\VikasProfileController::class, 'homePage']);

Route::middleware(['auth', 'ensure.user'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Pofile
    Route::get('/my-profile', [ProfileController::class , 'index'])->name('profile');

    //About
    Route::get('/about-me',[AboutController::class, 'index'])->name('aboutMe');

    //Activities
    Route::get('/my-activities',[ActivitiesController::class, 'index'])->name('myActivities');

    //Education
    Route::get('/my-education',[EducationController::class, 'index'])->name('education');

    //Experiance
    Route::get('/my-experiance',[ExperianceController::class, 'index'])->name('experiance');

});
