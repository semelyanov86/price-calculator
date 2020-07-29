<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Scan Queues
    Route::delete('scan-queues/destroy', 'ScanQueueController@massDestroy')->name('scan-queues.massDestroy');
    Route::resource('scan-queues', 'ScanQueueController');

    // Scan Proxies
    Route::delete('scan-proxies/destroy', 'ScanProxyController@massDestroy')->name('scan-proxies.massDestroy');
    Route::resource('scan-proxies', 'ScanProxyController');

    // User Datas
    Route::delete('user-datas/destroy', 'UserDataController@massDestroy')->name('user-datas.massDestroy');
    Route::resource('user-datas', 'UserDataController');

    // Scan Data Cellulars
    Route::delete('scan-data-cellulars/destroy', 'ScanDataCellularController@massDestroy')->name('scan-data-cellulars.massDestroy');
    Route::resource('scan-data-cellulars', 'ScanDataCellularController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});

Route::get('/phone', 'MainController@index')->name('phone.index');
Route::get('/phone/{data}', 'MainController@show')->name('phone.show');
