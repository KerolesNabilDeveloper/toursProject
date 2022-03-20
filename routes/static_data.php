<?php

Route::group([
    'middleware' => ['web'],
    'namespace'  => 'front'

], function () {

    #region settings

        Route::get('countries/list', 'SearchStaticDataController@searchCountries'); // done
        Route::get('cities/hotels/list', 'SearchStaticDataController@searchCitiesForHotel'); // done
        Route::get('cities/flights/list', 'SearchStaticDataController@searchAirportsForFlight'); // done

    #endregion

});

