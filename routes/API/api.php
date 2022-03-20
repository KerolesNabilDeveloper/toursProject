<?php


Route::group([
    'prefix'     => 'static-data',
], function () {


    Route::get('list-countries', 'StaticDataController@listCountries');
    Route::get('list-cities/{id}', 'StaticDataController@listCities');


});
