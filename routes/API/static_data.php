<?php

Route::group([
    'middleware' => []
], function () {

    #region settings

        Route::get('countries/list', 'StaticDataController@searchCountries');
        Route::get('cities/hotels/list', 'StaticDataController@searchCitiesForHotel');
        Route::get('cities/flights/list', 'StaticDataController@searchCitiesForFlight');
        Route::get('payment/list', 'StaticDataController@paymentList');
        Route::get('memberships/list', 'StaticDataController@membershipsList');

    #endregion

});
