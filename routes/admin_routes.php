<?php

Route::group([
    'middleware' => 'check_admin',
    'namespace'  => 'admin'
], function () {

    #region Start General Function Routing

    Route::post('/general_remove_item', 'DashboardController@general_remove_item');
    Route::post('/reorder_items', 'DashboardController@reorder_items');
    Route::post('/accept_item', 'DashboardController@accept_item');
    Route::post('/new_accept_item', 'DashboardController@new_accept_item');
    Route::post('/remove_admin', 'DashboardController@remove_admin');
    Route::post('/general_self_edit', 'DashboardController@general_self_edit');
    Route::post("/edit_slider_item", 'DashboardController@edit_slider_item');

    #endregion

});

Route::group([
    'middleware' => 'check_admin',
    'prefix'     => 'admin',
    'namespace'  => 'admin'
], function () {

    Route::get('dashboard', 'DashboardController@index');

    #region countries

    Route::get('countries', 'CountriesController@index');

    Route::get('countries/save/{country_id?}', 'CountriesController@save')->where('country_id', '([0-9]*)*');
    Route::post('countries/save/{country_id?}', 'CountriesController@save')->where('country_id', '([0-9]*)*');

    Route::post('countries/delete', 'CountriesController@delete');

    #endregion

    #region cities

    Route::get('cities', 'CitiesController@index');

    Route::get('cities/save/{city_id?}', 'CitiesController@save')->where('city_id', '([0-9]*)*');
    Route::post('cities/save/{city_id?}', 'CitiesController@save')->where('city_id', '([0-9]*)*');

    Route::post('cities/delete', 'CitiesController@delete');

    #endregion

    #region memberships

    Route::get('memberships', 'MembershipsController@index');

    Route::get('memberships/save/{membership_id?}', 'MembershipsController@save')->where('membership_id', '([0-9]*)*');
    Route::post('memberships/save/{membership_id?}', 'MembershipsController@save')->where('membership_id', '([0-9]*)*');

    Route::post('memberships/delete', 'MembershipsController@delete');

    #endregion

    #region payment_methods

    Route::get('payment-methods', 'PaymentMethodsController@index');

    Route::get('payment-methods/save/{payment_method_id}', 'PaymentMethodsController@save')->where('payment_method_id', '([0-9]*)*');
    Route::post('payment-methods/save/{payment_method_id}', 'PaymentMethodsController@save')->where('payment_method_id', '([0-9]*)*');

    #endregion

    #region comment-report-reasons

    Route::get('comment-report-reasons', 'CommentReportReasonsController@index');

    Route::get('comment-report-reasons/save/{item_id?}', 'CommentReportReasonsController@save')->where('item_id', '([0-9]*)*');
    Route::post('comment-report-reasons/save/{item_id?}', 'CommentReportReasonsController@save')->where('item_id', '([0-9]*)*');

    Route::post('comment-report-reasons/delete', 'CommentReportReasonsController@delete');

    #endregion

    #region blacklist-words

    Route::get('blacklist-words', 'BlacklistWordsController@index');

    Route::get('blacklist-words/save/{item_id?}', 'BlacklistWordsController@save')->where('item_id', '([0-9]*)*');
    Route::post('blacklist-words/save/{item_id?}', 'BlacklistWordsController@save')->where('item_id', '([0-9]*)*');

    Route::post('blacklist-words/delete', 'BlacklistWordsController@delete');

    #endregion

    #region cancellation-reasons

    Route::get('cancellation-reasons', 'CancellationReasonsController@index');

    Route::get('cancellation-reasons/save/{item_id?}', 'CancellationReasonsController@save')->where('item_id', '([0-9]*)*');
    Route::post('cancellation-reasons/save/{item_id?}', 'CancellationReasonsController@save')->where('item_id', '([0-9]*)*');

    Route::post('cancellation-reasons/delete', 'CancellationReasonsController@delete');

    #endregion

    #region auctions

    Route::get('auctions', 'AuctionsController@index');

    Route::get('auctions/save/{item_id?}', 'AuctionsController@save')->where('item_id', '([0-9]*)*');
    Route::post('auctions/save/{item_id?}', 'AuctionsController@save')->where('item_id', '([0-9]*)*');

    Route::post('auctions/delete', 'AuctionsController@delete');

    #endregion


    #region tours

    Route::get('getTours', 'ToursController@getTours');



    Route::get('tours', 'ToursController@index');

    Route::get('tours/save/{item_id?}', 'ToursController@save')->where('item_id', '([0-9]*)*');
    Route::post('tours/save/{item_id?}', 'ToursController@save')->where('item_id', '([0-9]*)*');

    Route::post('tours/delete', 'ToursController@delete');

    #endregion

    #region deals

    Route::get('deals', 'DealsController@index');

    Route::get('deals/save/{item_id?}', 'DealsController@save')->where('item_id', '([0-9]*)*');
    Route::post('deals/save/{item_id?}', 'DealsController@save')->where('item_id', '([0-9]*)*');

    Route::post('deals/delete', 'DealsController@delete');

    #endregion

    #region edit_content
    Route::get('site-content/show_methods', 'EditContent@show_methods');
    Route::post('site-content/show-content-spans-at-front', 'EditContent@showContentSpansAtFront');

    Route::get('site-content/edit_content/{lang_title}/{slug}', 'EditContent@check_function')->where("lang_title", "([a-z]*)*");;
    Route::post('site-content/edit_content/{lang_title}/{slug}', 'EditContent@check_function')->where("lang_title", "([a-z]*)*");;

    Route::get("site-content/copy_from_lang_to_another", 'EditContent@copy_from_lang_to_another');
    Route::post("site-content/copy_from_lang_to_another", 'EditContent@copy_from_lang_to_another');

    #endregion



    #region contact_us

    Route::get('contact', 'ContactController@index');

    #endregion

    #region booking

    Route::get('booking', 'BookingController@index');
    //Route::get('booking/show_data/{booking_id?}', 'BookingController@showData')->where('booking_id', '([0-9]*)*');

    #endregion



    #region push

    Route::get('push/devices/{device_type?}', 'PushController@devices');
    Route::get('push', 'PushController@save');
    Route::post('push', 'PushController@save');
    Route::post('push/delete', 'PushController@delete');

    #endregion

    #region admin theme settings
    Route::get('theme/change_direction/{locale}', 'ThemeController@changeDirectionController');
    Route::get('theme/change_menu/{menu_display}', 'ThemeController@changeMenuController');
    Route::post('theme/dark_mode', 'ThemeController@DarkModeController');
    #endregion

    #region settings
    Route::get('settings', 'SettingsController@index');
    Route::post('settings', 'SettingsController@index');
    #endregion

    #region notifications

    Route::get('notifications/show_all/{not_type}', 'NotificationController@index');
    Route::post('notifications/delete', 'NotificationController@delete');
    Route::post('notifications_seen', 'NotificationController@seen_notifications');

    #endregion

    #region Languages
    Route::get('/langs', 'LanguagesController@index');
    Route::get('/langs/save/{lang_id?}', 'LanguagesController@save');
    Route::post('/langs/save/{lang_id?}', 'LanguagesController@save');
    Route::post('/langs/delete_lang', 'LanguagesController@delete');
    #endregion

    #region static pages

    Route::get('pages', 'PagesController@index');

    Route::get('pages/save/{page_id?}', 'PagesController@save')->where('page_id', '([0-9]*)*');
    Route::post('pages/save/{page_id?}', 'PagesController@save')->where('page_id', '([0-9]*)*');

    Route::post('pages/delete', 'PagesController@delete');

    #endregion

    #region static categories

    Route::get('categories', 'CategoriesController@index');

    Route::post('categories/get-cats-parent-of-lang', 'CategoriesController@getParentOfCatsOfLang');


    Route::get('categories/subs/{parent_id?}', 'CategoriesController@showSubsCategoriesParent');

    Route::get('categories/sub/tours/{parent_id?}', 'CategoriesController@showToursOfCatchild');

    Route::get('categories/all','CategoriesController@getNestedViewOfCatsAvailableLangs');

    Route::get('categories/save/{item_id?}', 'CategoriesController@save')->where('item_id', '([0-9]*)*');
    Route::post('categories/save/{item_id?}', 'CategoriesController@save')->where('item_id', '([0-9]*)*');
    Route::post('categories/get-lang-cats-to-tour', 'CategoriesController@getLangCats');

    Route::post('categories/delete', 'CategoriesController@delete');

    #endregion



    #endregion

    #region admins

    Route::get('admins', 'AdminController@index');

    Route::get('admins/save/{admin_id?}', 'AdminController@save')->where("admin_id", "([0-9]*)*");
    Route::post('admins/save/{admin_id?}', 'AdminController@save')->where("admin_id", "([0-9]*)*");

    Route::post('admins/delete', 'AdminController@delete');

    Route::get('admins/assign_permission/{user_id}', 'AdminController@assign_permission');
    Route::post('admins/assign_permission/{user_id}', 'AdminController@assign_permission');

    Route::post('admins/permissions-multi-accepters', 'AdminController@permissionsMultiAccepters');

    #endregion

    #region users

    Route::get('users', 'UsersController@index');

    #endregion

    #region chat

    Route::get('chats/all', 'ChatController@getUserChats');
    Route::get('chats/get-chat/{chat_enc_id}', 'ChatController@getChat');
    Route::get('chats/get-more-msgs/{chat_enc_id}', 'ChatController@getMoreMsgs');
    Route::post('chats/send-message/{chat_enc_id}', 'ChatController@sendMessage');
    Route::post('chats/remove-message/{chat_enc_id}', 'ChatController@removeMessage');

    #endregion

});



