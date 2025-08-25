<?php

use App\Http\Controllers\Web\Admin\Pos\CreatePosController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/admin/category');

Route::view('/admin/login', 'layouts.admin.auth.index')->name('admin.login')->middleware('guest:admin');

Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::view('/profile', 'layouts.admin.profile.index')->name('profile.index');
    
    Route::group(['prefix' => 'pos', 'as' => 'pos.'], function() {
        Route::view('/', 'layouts.admin.pos.create')->name('add');
        Route::get('/search-branch', [CreatePosController::class, 'searchBranch'])->name('search-branch');
        Route::get('/search-customer', [CreatePosController::class, 'searchCustomer'])->name('search-customer');
        Route::view('/order', 'layouts.admin.pos.index')->name('index');
        Route::get('/order/{orderId}/detail', function($orderId) {
            return view('layouts.admin.pos.detail', ['orderId' => $orderId]);
        })->name('detail');
    });

    Route::group(['prefix' => 'verify-payment', 'as' => 'verify-payment.'], function(){
        Route::get('/{status}', function($status) {
            return view('layouts.admin.verify-payment.index', ['status' => $status]);
        })->name('index');
    });

    Route::group(['prefix' => 'order', 'as' => 'order.'], function(){
        Route::get('/{status}', function($status) {
            return view('layouts.admin.order.index', ['status' => $status]);
        })->name('index');
        Route::get('/{orderId}/detail', function($orderId) {
            return view('layouts.admin.order.detail', ['orderId' => $orderId]);
        })->name('detail');
    });

    Route::view('/category', 'layouts.admin.category.index')->name('category.index');
    
    Route::group(['prefix' => 'product', 'as' => 'product.'], function() {
        Route::view('/', 'layouts.admin.product.index')->name('index');
        Route::view('/add', 'layouts.admin.product.create')->name('add');
        Route::get('/{productId}/edit', function($productId) {
            return view('layouts.admin.product.edit', ['productId' => $productId]);
        })->name('edit');
        Route::view('/review', 'layouts.admin.product.review')->name('review');
        Route::get('/{productId}/review', function($productId) {
            return view('layouts.admin.product.review-detail', ['productId' => $productId]);
        })->name('review-detail');
    });

    Route::view('/banner', 'layouts.admin.banner.index')->name('banner.index');

    Route::group(['prefix' => 'delivery-man', 'as' => 'delivery-man.'], function() {
        Route::view('/', 'layouts.admin.delivery-man.index')->name('index');
        Route::view('/add', 'layouts.admin.delivery-man.create')->name('add');
        Route::get('/{deliveryManId}/detail', function($deliveryManId) {
            return view('layouts.admin.delivery-man.detail', ['deliveryManId' => $deliveryManId]);
        })->name('detail');
        Route::get('/{deliveryManId}/edit', function($deliveryManId) {
            return view('layouts.admin.delivery-man.edit', ['deliveryManId' => $deliveryManId]);
        })->name('edit');
        Route::view('/review', 'layouts.admin.delivery-man.review')->name('review');
        Route::get('/{deliveryManId}/review', function($deliveryManId) {
            return view('layouts.admin.delivery-man.review-detail', ['deliveryManId' => $deliveryManId]);
        })->name('review-detail');
    });

    Route::group(['prefix' => 'business-setting', 'as' => 'business-setting.'], function() {

        Route::view('/business-info', 'layouts.admin.business-setting.partials.business-info')
        ->name('business-info');
        Route::view('/store-time-schedule', 'layouts.admin.business-setting.partials.store-time-schedule')
        ->name('store-time-schedule');
        Route::get('/store-delivery-fees/branch/{branchId}', function($branchId) {
            return view('layouts.admin.business-setting.partials.store-delivery-fees', ['branchId' => $branchId]);
        })->name('store-delivery-fees');
        Route::view('/store-order-setting', 'layouts.admin.business-setting.partials.store-order-setting')
        ->name('store-order-setting');
    });

    Route::group(['prefix' => 'branch', 'as' => 'branch.'], function() {
        Route::view('/', 'layouts.admin.branch.index')->name('index');
        Route::view('/add', 'layouts.admin.branch.create')->name('add');
        Route::get('/{branchId}/edit', function($branchId) {
            return view('layouts.admin.branch.edit', ['branchId' => $branchId]);
        })->name('edit');
    });

});