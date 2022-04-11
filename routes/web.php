<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteProfessionController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
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



Route::prefix('cms')->middleware('guest:user,admin')->group(function () {
    Route::get('/{guard}/login', [AuthController::class, 'showLoginView'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);


    Route::get('user-register', [AuthController::class, 'showRegisterView'])->name('auth.register');
    Route::post('register', [AuthController::class, 'register']);


    Route::get('forgot-password', [ResetPasswordController::class, 'showForgotPassword'])->name('password.forgot');
    Route::post('forgot-password', [ResetPasswordController::class, 'sendResetLink']);
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPassword'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']);
});

Route::prefix('cms')->middleware('auth:admin,user')->group(function () {
    Route::get('email-verify', [EmailVerificationController::class, 'showEmailVerification'])->name('verification.notice');
    Route::get('email-verify/send', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('throttle:1,1');
    Route::get('verify/{id}/{hash}', [EmailVerificationController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
});


// Route::prefix('cms/admin')->group(function () {
//     Route::resource('admins', AdminController::class);
// });

Route::prefix('cms/admin')->middleware(['auth:admin', 'verified'])->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subCategories', SubCategoryController::class);
    Route::resource('users', UserController::class);
});

Route::prefix('cms/admin')->middleware(['auth:admin', 'verified'])->group(function () {


    Route::get('notifications', [NotificationController::class, 'index'])->name('user.notifications');

    Route::post('roles/permissions', [RoleController::class, 'updateRolePermission']);
    Route::get('users/{user}/permissions/edit', [UserController::class, 'editUserPermission'])->name('user.edit-permissions');
    Route::put('users/{user}/permissions', [UserController::class, 'updateUserPermission'])->name('user.update-permissions');
});

Route::prefix('cms/admin')->middleware(['auth:user,admin', 'verified'])->group(function () {
    Route::get('main', [MainPageController::class, 'showMainPage'])->name('cms.dashboard');

    Route::get('professions', [ProfessionController::class, 'showProfession'])->name('cms.profe');

    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('change-password', [AuthController::class, 'editPassword'])->name('auth.change-password');
    Route::post('update-password', [AuthController::class, 'updatePassword']);

    Route::resource('professions', ProfessionController::class);

    Route::resource('favoriteProfessions', FavoriteProfessionController::class);
});

// Route::prefix('cms/admin')->group(function () {
//     Route::view('/', 'cms.dashboard')->name('cms.dashboard');
//     Route::resource('users', UserController::class);
// });

// Route::get('/', function () {
//     return view('cms.dashboard');
// });
