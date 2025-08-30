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
use App\Http\Controllers\ProfilePageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

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

// Homepage Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/all-blogs', [HomeController::class, 'allBlogs'])->name('home.all-blogs');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit')
    ->middleware(['throttle:5,10', \Spatie\Honeypot\ProtectAgainstSpam::class]);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('forgot-password.submit')
    ->middleware(['throttle:3,15', \Spatie\Honeypot\ProtectAgainstSpam::class]);


Route::get('/health', [\App\Http\Controllers\HealthCheckController::class, 'index']);

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
        Route::get('/{slug}/edit', [BlogController::class, 'edit'])->name('edit');
        Route::get('/{slug}/preview', [BlogController::class, 'show'])->name('show');
        Route::put('/{slug}', [BlogController::class, 'update'])->name('update');
        Route::delete('/{slug}', [BlogController::class, 'destroy'])->name('destroy');
        Route::get('/{slug}/duplicate', [BlogController::class, 'duplicate'])->name('duplicate');
        Route::get('/{slug}/toggle-featured', [BlogController::class, 'toggleFeatured'])->name('toggle-featured');
    });

});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('create-user');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('store-user');
    Route::get('/users/{id}', [AdminController::class, 'userDetails'])->name('user-details');
    Route::post('/users/{id}/status', [AdminController::class, 'updateUserStatus'])->name('user-status');

    // Blog Management
    Route::get('/blogs', [AdminController::class, 'blogs'])->name('blogs');
    Route::get('/blogs/create', [AdminController::class, 'createBlog'])->name('create-blog');
    Route::post('/blogs', [AdminController::class, 'storeBlog'])->name('store-blog');
    Route::get('/blogs/{id}/edit', [AdminController::class, 'editBlog'])->name('edit-blog');
    Route::put('/blogs/{id}', [AdminController::class, 'updateBlog'])->name('update-blog');
    Route::delete('/blogs/{id}', [AdminController::class, 'deleteBlog'])->name('delete-blog');

    // Blog Subscribers Management
    Route::get('/subscribers', [AdminController::class, 'subscribers'])->name('subscribers');
    Route::post('/subscribers/{id}/unsubscribe', [AdminController::class, 'unsubscribeUser'])->name('unsubscribe-user');
    Route::post('/subscribers/{id}/resubscribe', [AdminController::class, 'resubscribeUser'])->name('resubscribe-user');
    Route::delete('/subscribers/{id}', [AdminController::class, 'deleteSubscriber'])->name('delete-subscriber');

    // Settings & Logs
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::get('/logs', [AdminController::class, 'logs'])->name('logs');
});

Route::prefix('blogs')->name('blogs.')->group(function () {
    Route::get('/{slug}', [ProfilePageController::class, 'publicShow'])->name('show');
    Route::post('/{slug}/comments', [ProfilePageController::class, 'storeComment'])
        ->name('comments.store')
        ->middleware(['throttle:10,15', \Spatie\Honeypot\ProtectAgainstSpam::class]);
});

// Contact Routes (must be before catch-all route)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])
    ->name('contact.submit')
    ->middleware([
        'throttle:5,10', // 5 requests per 10 minutes
        \Spatie\Honeypot\ProtectAgainstSpam::class
    ]);

// Blog Subscription Routes
Route::post('/blog/subscribe', [\App\Http\Controllers\BlogSubscriptionController::class, 'subscribe'])
    ->name('blog.subscribe')
    ->middleware([
        'throttle:5,10', // 5 subscription attempts per 10 minutes
        \Spatie\Honeypot\ProtectAgainstSpam::class
    ]);
Route::get('/blog/unsubscribe/{token}', [\App\Http\Controllers\BlogSubscriptionController::class, 'unsubscribe'])
    ->name('blog.unsubscribe');
Route::post('/blog/subscription-status', [\App\Http\Controllers\BlogSubscriptionController::class, 'status'])
    ->name('blog.subscription.status');

// Route for user profiles based on username (catch-all - must be last)
// Route::get('/{slug}', [ProfilePageController::class, 'show'])->name('profile.show');
Route::domain('{slug}.' . config('app.domain'))->group(function () {
    Route::get('/', [ProfilePageController::class, 'show'])
        ->name('profile.show');
});