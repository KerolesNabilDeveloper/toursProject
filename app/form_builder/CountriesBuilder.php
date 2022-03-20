<?php

namespace App\form_builder;

class CountriesBuilder extends FormBuilder
{

    public $translate_fields = [

        'country_name',

    ];

    public $cust_translate_fields_attrs = [

        "default_grid"     => "12",
        "default_required" => "required",
        "custom_labels"    => [
            "country_name" => "اسم الدولة",
        ],

    ];

}
