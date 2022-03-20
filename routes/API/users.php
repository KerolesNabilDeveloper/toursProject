<?php

Route::group([
    'middleware' => ['auth:api', 'APICheckUser'],
    'prefix'     => 'user',
    'namespace'  => 'User',
], function () {

    Route::get('get-his-data', 'UserController@getHisData');
    Route::put('edit-his-data', 'UserController@editHisData');

    Route::put('change-password', 'UserController@changePassword');

    Route::post('change-email', 'UserController@changeEmail');
    Route::put('verify-email', 'UserController@verifyChangeEmail');


});

Route::group([
    'middleware' => ['auth:api'],
    'prefix'     => 'vouchers',
    'namespace'  => 'User',
], function () {

    Route::get('logs', 'WalletVoucherController@getPreviousVouchersLogs');

    Route::post('add', 'WalletVoucherController@addNewVoucher');


});

Route::group([
    'middleware' => ['auth:api', 'APILocalization'],
    'prefix'     => 'orders',
    'namespace'  => 'User',
], function () {

    Route::get('auctions', 'OrdersController@getAuctionsOrders');
    Route::get('auctions/{order_id}', 'OrdersController@getAuctionsOrderDetails');
    Route::put('address/{order_id}', 'OrdersController@updateOrderShippingAddress');


    Route::get('deals', 'OrdersController@getDealsOrders');
    Route::get('deal/{order_id}', 'OrdersController@getDealsOrderDetails');


});
