<?php

Route::prefix('admin')->group(function () {
    Route::get('/', function() {
        return redirect()->route('admin.login');
    });
    Route::get('/login', '\Core\Controller\AELoginController@showLoginForm')->name('admin.login');
    Route::post('/login', '\Core\Controller\AELoginController@login')->name('admin.login.post');
    
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', '\Core\Controller\AEHomeController@index')->name('admin.home');
        Route::post('/logout', '\Core\Controller\AELoginController@logout')->name('admin.logout');

        Route::prefix('settings')->group(function () {
            Route::get('/', '\Core\Controller\Setting\SettingController@index')->name('setting.index');
            Route::post('/', '\Core\Controller\Setting\SettingController@store')->name('setting.store');
        });
        
    });
    
});

Route::get('/{slug?}', '\Core\Controller\AEController@index')->where('slug', '^(?!admin$).*$');