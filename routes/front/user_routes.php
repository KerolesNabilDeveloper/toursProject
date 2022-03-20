<?php

Route::group([
    'middleware' => ['check_user'],
    'prefix'     => 'user',
    'namespace'  => 'User'
], function () {

    Route::get('dashboard', 'DashboardController@index');

    Route::get('edit-profile', 'UserController@editHisData');
    Route::post('edit-profile', 'UserController@editHisData');

    Route::get('change-password', 'UserController@changePassword');
    Route::post('change-password', 'UserController@changePassword');

    Route::get('change-email', 'UserController@changeEmail');
    Route::post('change-email', 'UserController@changeEmail');


    #hotels-bookings
    Route::get('hotels-bookings/show', 'HotelBookingsController@listBookings');
    Route::get('hotels-bookings/details/{booking_id}', 'HotelBookingsController@bookingDetails');

    #flights-bookings
    Route::get('flights-bookings/show', 'FlightBookingsController@listBookings');
    Route::get('flights-bookings/details/{booking_id}', 'FlightBookingsController@bookingDetails');

});
