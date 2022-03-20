<?php

Route::group([
    'middleware' => ['auth:api', 'APICheckUser'],
    'prefix'     => 'chat',
], function () {


    Route::post('create-personal-chat', 'ChatController@createPersonalChat');
    Route::post('create-deal-chat/{item_id}', 'ChatController@createDealChat')->where('item_id', '([0-9]*)*');;
    Route::post('create-auction-chat/{item_id}', 'ChatController@createAuctionChat')->where('item_id', '([0-9]*)*');;
    Route::post('create-support-chat', 'ChatController@createSupportChat');

    Route::get('all', 'ChatController@getUserChats');
    Route::get('get-chat/{chat_enc_id}', 'ChatController@getChat');
    Route::get('get-more-msgs/{chat_enc_id}', 'ChatController@getMoreMessagesChat');
    Route::post('send-message/{chat_enc_id}', 'ChatController@sendMessage');
    Route::post('remove-message/{chat_enc_id}', 'ChatController@removeMessage');

});




