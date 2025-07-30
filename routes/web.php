<?php
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/admin/category');

Route::view('/admin/login', 'layouts.admin.auth.index')->name('admin.login')->middleware('guest:admin');

Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::view('/category', 'layouts.admin.category.index')->name('category.index');
    
    Route::group(['prefix' => 'product', 'as' => 'product.'], function() {
        Route::view('/', 'layouts.admin.product.index')->name('index');

        Route::view('/add', 'layouts.admin.product.create')->name('add');

        Route::view('/edit/{productId}', 'layouts.admin.product.edit')->name('edit');
    });
});