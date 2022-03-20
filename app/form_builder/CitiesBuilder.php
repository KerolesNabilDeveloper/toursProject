<?php

namespace App\form_builder;

use App\models\countries_m;

class CitiesBuilder extends FormBuilder
{

    public function __construct()
    {

        $this->select_fields["country_id"] = [
            "label_name" => "اختار الدولة",
            "class"      => "form-control select_2_primary",
            "grid"       => "col-md-12",
        ];

        $this->select_fields_data["country_id"] = function () {

            $allCats = countries_m::getAll();

            return [
                "text"   => $allCats->pluck("country_name")->all(),
                "values" => $allCats->pluck("country_id")->all(),
            ];

        };


    }

    public $translate_fields = [

        'city_name',

    ];

    public $cust_translate_fields_attrs = [

        "default_grid"     => "12",
        "default_required" => "required",
        "custom_labels"    => [
            "city_name" => "اسم الدولة",
        ],

    ];

}
