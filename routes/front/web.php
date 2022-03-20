 <?php

//Route::get('/clear_cache', function() {
//    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
//    $exitCode = \Illuminate\Support\Facades\Artisan::call('view:clear');
//    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:clear');
//    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:cache');
//    // return what you want
//});

// Web Routing

Route::group([
    'middleware' => ['web']
], function () {



        Route::get('contact','front\ContactController@getContact');



        Route::post('contact/message','front\ContactController@saveMessage');


        Route::post('booking/tour','front\BookingController@booking');
        Route::post('subscribers','front\SubscribeController@newsletter');

    #region blogs/

        Route::get('tours/{parent_cat_slug}/{child_cat_slug}','front\ToursController@showChildCategoryPage');
        Route::get('tours/{parent_cat_slug}/{child_cat_slug}/{tour_slug}','front\ToursController@showTourPage');
        Route::get('tours/{parent_cat_slug}','front\ToursController@showParentCategoryPage');

    #endregion

    #region blogs/

        Route::get('/blogs','front\BlogsController@index');
        Route::get('/blogs/categories/{cat_id}','front\BlogsController@showCategoryArticles');
        Route::get('/blogs/{page_title}/{page_id}','front\BlogsController@showArticle');

    #endregion


    #region pages

        Route::get('pages/{pages_slug}','front\PagesController@showPage');

        Route::get('/not_found_page','front\PagesController@showNotFoundPage')->name('not_found_page');

        Route::get('/pages/{page_title}/{page_id}','front\PagesController@showPage');

    #endregion


    #region pages

//        Route::post('/subscribe','front\SubscribeController@index');

    #endregion

    #region support

        Route::get('/support','front\SupportController@index');
        Route::post('/support','front\SupportController@sendRequest');

    #endregion



    #region dynamic image format

    Route::get('/uploads/{folder}/{target_image?}','FrontController@getFormattedImage');
    Route::get('/uploads/{folder1}/{folder2}/{target_image?}','FrontController@getFormattedImage');
    Route::get('/uploads/{folder1}/{folder2}/{folder3}/{target_image?}','FrontController@getFormattedImage');
    Route::get('/uploads/{folder1}/{folder2}/{folder3}/{folder4}/{target_image?}','FrontController@getFormattedImage');
    Route::get('/site_content/{folder1}/{folder2}/{folder3}/{folder4}/{target_image?}','FrontController@getFormattedImage');

    #endregion

    Route::get("/", 'front\HomeController@index');

});










