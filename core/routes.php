<?php

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() {
        return redirect()->route('admin.login');
    });
    Route::get('/login', '\Core\Http\Controller\AELoginController@showLoginForm')->name('login');
    Route::post('/login', '\Core\Http\Controller\AELoginController@login')->name('login.post');
    
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', '\Core\Http\Controller\AEHomeController@index')->name('home');
        Route::post('/logout', '\Core\Http\Controller\AELoginController@logout')->name('logout');

        Route::prefix('settings')->group(function () {
            Route::get('/', '\Core\Http\Controller\Setting\SettingController@index')->name('settings.index');
            Route::post('/', '\Core\Http\Controller\Setting\SettingController@store')->name('settings.store');
        });

        Route::prefix('users')->group(function () {
            Route::get('/data', '\Core\Http\Controller\User\UserController@data')->name('users.data');
        });
        Route::resource('users','\Core\Http\Controller\User\UserController');
        
        Route::prefix('roles')->group(function () {
            Route::get('/data', '\Core\Http\Controller\Role\RoleController@data')->name('roles.data');
        });
        Route::resource('roles','\Core\Http\Controller\Role\RoleController');
        
        Route::prefix('modules')->group(function () {
            Route::get('/data', '\Core\Http\Controller\Module\ModuleController@data')->name('modules.data');
        });
        Route::resource('modules','\Core\Http\Controller\Module\ModuleController');
        
        Route::prefix('pages')->group(function () {
            Route::get('/data', '\Core\Http\Controller\Page\PageController@data')->name('pages.data');
            Route::get('/template', '\Core\Http\Controller\Page\PageController@template')->name('pages.template');
        });
        Route::resource('pages','\Core\Http\Controller\Page\PageController');
        
        Route::prefix('menus')->group(function () {
            Route::get('/data', '\Core\Http\Controller\Menu\MenuController@data')->name('menus.data');
        });
        Route::resource('menus','\Core\Http\Controller\Menu\MenuController');
    });
    
});

Route::get('/{slug?}', '\Core\Http\Controller\AEController@index')->where('slug', '^(?!admin$).*$');