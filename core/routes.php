<?php

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() {
        return redirect()->route('admin.login');
    });
    Route::get('/login', '\Core\Http\Controller\AELoginController@showLoginForm')->name('login');
    Route::post('/login', '\Core\Http\Controller\AELoginController@login')->name('login.post');
    
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', '\Core\Http\Controller\AEHomeController@index')->name('dashboard');
        Route::post('/logout', '\Core\Http\Controller\AELoginController@logout')->name('logout');

        Route::prefix('settings')->group(function () {
            Route::get('/', '\Core\Http\Controller\Setting\SettingController@index')->name('settings.index');
            Route::post('/', '\Core\Http\Controller\Setting\SettingController@store')->name('settings.store');
        });

        Route::prefix('users')->group(function () {
            Route::get('/data', '\Core\Http\Controller\User\UserController@data')->name('users.data');
            Route::get('/trashed', '\Core\Http\Controller\User\UserController@trashed')->name('users.trashed');
            Route::get('/restore/{id?}', '\Core\Http\Controller\User\UserController@restore')->name('users.restore');
            Route::post('/restore/{id}', '\Core\Http\Controller\User\UserController@processrestore')->name('users.processrestore');
            Route::delete('/forcedelete/{id?}', '\Core\Http\Controller\User\UserController@forcedelete')->name('users.forcedelete');
            Route::get('/logs', '\Core\Http\Controller\User\UserLogController@data')->name('users.log.data');
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
            Route::get('/trashed', '\Core\Http\Controller\Page\PageController@trashed')->name('pages.trashed');
            Route::get('/restore/{id?}', '\Core\Http\Controller\Page\PageController@restore')->name('pages.restore');
            Route::post('/restore/{id}', '\Core\Http\Controller\Page\PageController@processrestore')->name('pages.processrestore');
            Route::delete('/forcedelete/{id?}', '\Core\Http\Controller\Page\PageController@forcedelete')->name('pages.forcedelete');
        });
        Route::resource('pages','\Core\Http\Controller\Page\PageController');
        
        Route::prefix('menus')->group(function () {
            Route::get('/data', '\Core\Http\Controller\Menu\MenuController@data')->name('menus.data');
        });
        Route::resource('menus','\Core\Http\Controller\Menu\MenuController');
        
        Route::prefix('files')->group(function () {
            Route::get('/data', '\Core\Http\Controller\UploadedFiles\FileController@data')->name('files.data');
        });
        Route::resource('files','\Core\Http\Controller\UploadedFiles\FileController');
        
        Route::prefix('contents')->group(function () {
            Route::get('/data', '\Core\Http\Controller\Content\ContentController@data')->name('contents.data');
        });
        Route::resource('contents','\Core\Http\Controller\Content\ContentController');
        
        Route::prefix('offices')->group(function () {
            Route::get('/data', '\Core\Http\Controller\Office\OfficeController@data')->name('offices.data');
            Route::get('/trashed', '\Core\Http\Controller\Office\OfficeController@trashed')->name('offices.trashed');
            Route::get('/restore/{id?}', '\Core\Http\Controller\Office\OfficeController@restore')->name('offices.restore');
            Route::post('/restore/{id}', '\Core\Http\Controller\Office\OfficeController@processrestore')->name('offices.processrestore');
            Route::delete('/forcedelete/{id?}', '\Core\Http\Controller\Office\OfficeController@forcedelete')->name('offices.forcedelete');
        });
        Route::resource('offices','\Core\Http\Controller\Office\OfficeController');
    });
    
});

Route::get('/{slug?}', '\Core\Http\Controller\AEController@index')->where('slug', '^(?!admin$).*$');