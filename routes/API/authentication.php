<?php

Route::group([
    'middleware' => []
], function () {

    Route::post('login', 'AuthController@login');
    Route::post('social-login', 'AuthController@socialLogin');

    Route::post('check-user-mobile-phone-is-unique', 'AuthController@checkUserMobilePhoneIsUnique');
    Route::post('register-as-user', 'AuthController@registerAsUser');

    Route::post('account-verification', 'AuthController@accountVerification');
    Route::post('resend-verification-code', 'AuthController@reSendVerificationCode');

    Route::post('forget-password-request', 'AuthController@forgetPasswordRequest');
    Route::post('reset-password', 'AuthController@resetPassword');

    Route::post('logout', 'AuthController@logout');

});
