<?php

Route::prefix('admin')->group(function () {
    Route::get('/', function() {
        return redirect()->route('admin.login');
    });
    Route::get('/login', '\Core\Http\Controller\AELoginController@showLoginForm')->name('admin.login');
    Route::post('/login', '\Core\Http\Controller\AELoginController@login')->name('admin.login.post');
    
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', '\Core\Http\Controller\AEHomeController@index')->name('admin.home');
        Route::post('/logout', '\Core\Http\Controller\AELoginController@logout')->name('admin.logout');

        Route::prefix('settings')->group(function () {
            Route::get('/', '\Core\Http\Controller\Setting\SettingController@index')->name('settings.index');
            Route::post('/', '\Core\Http\Controller\Setting\SettingController@store')->name('settings.store');
        });

        Route::prefix('users')->group(function () {
            Route::get('/', '\Core\Http\Controller\User\UserController@index')->name('users.index');
            Route::get('/create', '\Core\Http\Controller\User\UserController@create')->name('users.create');
            Route::post('/', '\Core\Http\Controller\User\UserController@store')->name('users.store');
        });
        
        Route::resource('roles','\Core\Http\Controller\Role\RoleController');
    });
    
});

Route::get('/{slug?}', '\Core\Http\Controller\AEController@index')->where('slug', '^(?!admin$).*$');