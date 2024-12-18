<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminEmailController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminEnquiryController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;

Route::group(['prefix' => 'admin', 'middleware' => 'revalidate'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    // Login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin-login');

    // Forgot Password
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');

    // Reset Password
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'updatePassword'])->name('admin.password.update');

    Route::group(['middleware' => 'auth:admin', 'as' => 'admin.'], function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        // Change password
        Route::get('change-password', [ChangePasswordController::class, 'changePassword'])->name('change.password');
        Route::post('change-password', [ChangePasswordController::class, 'updatePassword'])->name('update.password');

        // User routes
        Route::resource('user', AdminUserController::class)->except(['destroy', 'show']);
        Route::post('user/delete', [AdminUserController::class, 'delete'])->name('user.delete');
        Route::post('user/block', [AdminUserController::class, 'block'])->name('user.block');
        Route::get('user/view', [AdminUserController::class, 'view'])->name('user.view');
        Route::post('user/exists', [AdminUserController::class, 'checkExists'])->name('user.exists');

        // Enquiry routes
        Route::resource('enquiry', AdminEnquiryController::class)->except(['destroy', 'show']);
        Route::delete('enquiry/delete', [AdminEnquiryController::class, 'delete'])->name('enquiry.delete');

        // Email routes
        Route::any('email', [AdminEmailController::class, 'index'])->name('email');
        Route::get('add-email', [AdminEmailController::class, 'add'])->name('add.email');
        Route::post('store-email', [AdminEmailController::class, 'store'])->name('store.email');
        Route::get('edit-email/{id}', [AdminEmailController::class, 'edit'])->name('edit.email');
        Route::post('update-email', [AdminEmailController::class, 'update'])->name('update.email');
        Route::post('delete-email', [AdminEmailController::class, 'delete'])->name('delete.email');

        // Settings
        Route::get('edit/privacy-policy', [AdminController::class, 'editPageContent'])->name('privacy-policy');
        Route::get('edit/terms-conditions', [AdminController::class, 'editPageContent'])->name('terms-&-conditions');
        Route::get('edit/about-us', [AdminController::class, 'editPageContent'])->name('about-us');
        Route::post('save-page-content', [AdminController::class, 'savePageContent'])->name('save.pageContent');

        Route::resource('blogs', AdminBlogController::class);
        Route::post('blogs/get', [AdminBlogController::class, 'getBlog'])->name('blogs.get');
        Route::post('blogs/exists', [AdminBlogController::class, 'exists'])->name('blogs.exists');

        // Settings
        Route::get('settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('save-settings', [AdminController::class, 'saveSettings'])->name('save.settings');
        Route::get('edit/about-us', [AdminController::class, 'editPageContent'])->name('about-us');
        Route::get('edit/teacher-privacy-policy', [AdminController::class, 'editPageContent'])->name('teacher-privacy-policy');
        Route::get('edit/school-privacy-policy', [AdminController::class, 'editPageContent'])->name('school-privacy-policy');
        Route::get('edit/teacher-terms-conditions', [AdminController::class, 'editPageContent'])->name('teacher-terms-conditions');
        Route::get('edit/school-terms-conditions', [AdminController::class, 'editPageContent'])->name('school-terms-conditions');
        Route::post('save-page-content', [AdminController::class, 'savepageContent'])->name('save.pageContent');
    });
});
