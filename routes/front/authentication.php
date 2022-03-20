<?php

Route::group([
    'middleware' => ['web']
], function () {

    #region Login
    Route::get('login','front\AuthController@login');
    Route::post('login','front\AuthController@login');

    Route::get('login-with-social/{social}','front\AuthController@loginWithSocial')->where('social','(facebook|google)');
    Route::get('social-callback/{social}','front\AuthController@socialCallback')->where('social','(facebook|google)');

//    Route::get('register-as-user','front\AuthController@registerAsUser');
//    Route::post('register-as-user','front\AuthController@registerAsUser');

    Route::get('register-as-agent','front\AuthController@registerAsAgent');
    Route::post('register-as-agent','front\AuthController@registerAsAgent');

    Route::get('account-verification','front\AuthController@accountVerification');
    Route::post('account-verification','front\AuthController@accountVerification');

    Route::get('forget-password-request','front\AuthController@forgetPasswordRequest');
    Route::post('forget-password-request','front\AuthController@forgetPasswordRequest');

    Route::get('reset-password','front\AuthController@resetPassword');
    Route::post('reset-password','front\AuthController@resetPassword');


    Route::get("logout","logout@index");
    #endregion
});










