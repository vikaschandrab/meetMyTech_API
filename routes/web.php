<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActivitiesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperianceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\BlogController;

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

Route::get('/login', [AuthController::class, 'index'])->name('login');
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
    Route::post('/profile/update', [ProfileController::class, 'userUpdate'])->name('profile.update');

    //About
    Route::get('/about-me',[AboutController::class, 'index'])->name('aboutMe');
    Route::post('/aboute-me/update',[AboutController::class,'updateAbout'])->name('abouteMe.update');

    //Activities
    Route::get('/my-activities',[ActivitiesController::class, 'index'])->name('myActivities');
    Route::post('/my-activities/store', [ActivitiesController::class, 'saveOrUpdateActivity'])->name('activities.store');
    Route::post('my-activities/professional-skills', [ActivitiesController::class, 'updateProfessionalSkills'])->name('activities.professionalSkills');
    Route::delete('/my-activities/delete/{id}', [ActivitiesController::class, 'deleteActivity'])->name('activities.delete');


    //Education
    Route::get('/my-education',[EducationController::class, 'index'])->name('education');
    Route::post('/my-education/add', [EducationController::class, 'addEducation'])->name('education.add');
    Route::put('/my-education/update/{id}', [EducationController::class, 'update'])->name('education.update');
    Route::delete('/my-education/delete/{id}', [EducationController::class, 'delete'])->name('education.delete');


    //Experiance
    Route::get('/my-experiance',[ExperianceController::class, 'index'])->name('experiance');
    Route::post('/work-experience/add', [ExperianceController::class, 'addWorkExperience'])->name('work-experience.add');
    Route::put('/work-experience/{id}', [ExperianceController::class, 'update'])->name('work-experience.update');
    Route::delete('/work-experience/{id}', [ExperianceController::class, 'delete'])->name('work-experience.delete');

    //SiteSettings
    Route::get('/site-settings',[SiteSettingsController::class, 'index'])->name('site-settings');
    Route::post('/site-settings/update', [SiteSettingsController::class, 'update'])->name('site-settings.update');
    Route::delete('/site-settings/delete', [SiteSettingsController::class, 'delete'])->name('site-settings.delete');

    // Blog Routes
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/create', [BlogController::class, 'create'])->name('create');
        Route::post('/', [BlogController::class, 'store'])->name('store');
        Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
        Route::get('/{slug}/edit', [BlogController::class, 'edit'])->name('edit');
        Route::put('/{slug}', [BlogController::class, 'update'])->name('update');
        Route::delete('/{slug}', [BlogController::class, 'destroy'])->name('destroy');
        Route::get('/{slug}/duplicate', [BlogController::class, 'duplicate'])->name('duplicate');
        Route::get('/{slug}/toggle-featured', [BlogController::class, 'toggleFeatured'])->name('toggle-featured');
    });

});
