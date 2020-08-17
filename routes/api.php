<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Scan Queues
    Route::apiResource('scan-queues', 'ScanQueueApiController');

    // Scan Proxies
    Route::apiResource('scan-proxies', 'ScanProxyApiController');

    // User Datas
    Route::apiResource('user-datas', 'UserDataApiController');

    // Scan Data Cellulars
    Route::apiResource('scan-data-cellulars', 'ScanDataCellularApiController');
});

Route::post('/data', 'Api\\UserDataController@store')->name('data.store');
Route::post('/data/{data}', 'Api\\UserDataController@update')->name('data.store');
Route::post('/user-data/order/{userData}', 'Api\\UserDataController@order')->name('data.order');
