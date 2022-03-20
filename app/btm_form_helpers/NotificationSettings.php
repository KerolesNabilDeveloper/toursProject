<?php

namespace App\btm_form_helpers;

class NotificationSettings
{


    public static $adminSettings = [
        #common
        "all",
        "hotel_bookings", "flight_bookings",
        "tickets_notifications",
        "offline_package_notifications",

        #for admins only
        "financial_with_agencies",
        "support_requests",
    ];

    public static $agencySettings = [
        #common
        "all",
        "hotel_bookings", "flight_bookings",
        "tickets_notifications",
        "offline_package_notifications",

        #for agency only
        "money_transfers",

    ];





}
