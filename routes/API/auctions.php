<?php

Route::group([
    'middleware' => ['shouldUseApi'],
    'prefix'     => 'auctions',
], function () {


    Route::get('list/current', 'AuctionsController@getCurrentAuctions');
    Route::get('list/coming', 'AuctionsController@getComingAuctions');
    Route::get('list/closed', 'AuctionsController@getClosedAuctions');

    Route::get('details/{id}', 'AuctionsController@getAuctionDetails');


});

Route::group([
    'middleware' => ['auth:api', 'APICheckUser'],
    'prefix'     => 'auctions',
], function () {


    Route::post('subscribe/{id}', 'AuctionsController@subscribeToAuction');

    Route::post('bid/{id}', 'AuctionsController@bidAtAuction');



});
