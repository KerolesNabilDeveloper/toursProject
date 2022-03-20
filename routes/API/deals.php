<?php

Route::group([
    'middleware' => ['shouldUseApi'],
    'prefix'     => 'deals',
], function () {


    Route::get('list/current', 'DealsController@getCurrentDeals');
    Route::get('list/coming', 'DealsController@getComingDeals');
    Route::get('list/closed', 'DealsController@getClosedDeals');
    Route::get('details/{id}', 'DealsController@getDealDetails');



});

Route::group([
    'middleware' => ['auth:api', 'APICheckUser'],
    'prefix'     => 'deals',
], function () {

    Route::post('notifier', 'DealsController@createNotifierDeal');

    Route::post('add/cart', 'DealsController@addTocCart');
    Route::get('cart', 'DealsController@getCart');
    Route::delete('cart/all', 'DealsController@deleteItemFromCartAll');
    Route::delete('cart/{item_id}', 'DealsController@deleteItemFromCart');

    Route::post('checkout/{cart_item_id}', 'DealsController@checkoutCart')->where('cart_item_id', '[0-9]+');


});
