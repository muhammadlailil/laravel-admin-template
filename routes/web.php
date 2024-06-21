<?php

use App\Http\Controllers\Admin\Developer\AdminAuthenticationController;
use App\Http\Controllers\Admin\Developer\AdminImportLogController;
use App\Http\Controllers\Admin\Developer\AdminManagePermissionController;
use App\Http\Controllers\Admin\Developer\AdminUserManagementController;
use App\Http\Controllers\Admin\Utility\AdminNotificationController;
use App\Http\Controllers\Admin\Utility\AdminProfileController;
use App\Http\Controllers\Admin\Utility\AdminSettingController;
use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', config('admin.home'));

Route:: as('admin.')
    ->prefix(config('admin.path'))
    ->group(function () {

        Route::controller(AdminAuthenticationController::class)
            ->as('auth.')
            ->prefix('auth')
            ->group(function () {
                Route::get('/login', 'login')->name('login');
                Route::post('/login', 'postLogin')->name('post-login');
            });

        Route::middleware([AdminAuthMiddleware::class])
            ->group(function () {
                Route::post('/auth/logout', [AdminAuthenticationController::class, 'logout'])->name('auth.logout');
                Route::get('/{category}/import-logs', [AdminImportLogController::class, 'index'])->name('import-log.index');

                Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
                Route::resource('/role-permission', AdminManagePermissionController::class)->except(['show']);
                Route::resource('/user-management', AdminUserManagementController::class)->except(['show']);

                Route::resource('/setting', AdminSettingController::class)
                    ->whereIn('category', ['ppn', 'company-information', 'bank-information'])
                    ->except(["create", "update", "edit", "destroy", "show"]);
                    
                Route::controller(AdminProfileController::class)
                    ->prefix('profile')
                    ->as('profile.')
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::post('/store', 'store')->name('store');
                    });
                
                    Route::get('/about', [AdminProfileController::class, 'about'])->name('about');

                Route::controller(AdminNotificationController::class)
                    ->prefix('notification')
                    ->as('notification.')
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/{uuid}', 'detail')->name('detail');
                    });

            });
    });