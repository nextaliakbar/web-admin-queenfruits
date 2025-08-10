<?php
use App\Livewire\Admin\Auth\LoginLivewire;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/admin/category');

Route::view('/admin/login', 'layouts.admin.auth.index')->name('admin.login')->middleware('guest:admin');

Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::view('/profile', 'layouts.admin.profile.index')->name('profile.index');
    
    Route::view('/category', 'layouts.admin.category.index')->name('category.index');
    
    Route::group(['prefix' => 'product', 'as' => 'product.'], function() {
        Route::view('/', 'layouts.admin.product.index')->name('index');

        Route::view('/add', 'layouts.admin.product.create')->name('add');

        Route::view('/edit/{productId}', 'layouts.admin.product.edit')->name('edit');
    });

    Route::view('/banner', 'layouts.admin.banner.index')->name('banner.index');

    Route::group(['prefix' => 'business-setting', 'as' => 'business-setting.'], function() {

        Route::view('/business-info', 'layouts.admin.business-setting.partials.business-info')
        ->name('business-info');

        Route::view('/store-time-schedule', 'layouts.admin.business-setting.partials.store-time-schedule')
        ->name('store-time-schedule');

        Route::view('/store-delivery-fees/branch/{branchId}', 'layouts.admin.business-setting.partials.store-delivery-fees')
        ->name('store-delivery-fees');

        Route::view('/store-order-setting', 'layouts.admin.business-setting.partials.store-order-setting')
        ->name('store-order-setting');
    });

    Route::group(['prefix' => 'branch', 'as' => 'branch.'], function() {
        Route::view('/', 'layouts.admin.branch.index')->name('index');
        Route::view('/add', 'layouts.admin.branch.create')->name('add');
        Route::view('/edit/{branchId}', 'layouts.admin.branch.edit')->name('edit');
    });

});