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