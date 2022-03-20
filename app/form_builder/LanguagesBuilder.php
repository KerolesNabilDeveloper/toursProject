<?php

namespace App\form_builder;

class LanguagesBuilder extends FormBuilder
{

    public function __construct()
    {

        $this->select_fields_data["lang_is_active"] = function () {

            return [
                "text"   => ["no", "yes"],
                "values" => ["0", "1"],
            ];

        };
        $this->select_fields_data["lang_is_rtl"] = function () {

            return [
                "text"   => ["no", "yes"],
                "values" => ["0", "1"],
            ];

        };

    }

    public $select_fields = [
        'lang_is_active' => [
            "label_name" => "Available?",
            "class"      => "form-control select_2_primary",
            "grid"       => "col-md-6",
        ],
        'lang_is_rtl' => [
            "label_name" => "Support Arabic language format?",
            "class"      => "form-control select_2_primary",
            "grid"       => "col-md-6",
        ],
    ];

    public $normal_fields = [
        'lang_title', "lang_text"
    ];

    public $normal_fields_custom_attrs = [
        "default_grid"     => "6",
        "default_required" => "required",
        "custom_labels"    => [
            "lang_title"        => "language code. (example en) ",
            "lang_text"         => "Language title ",
        ],
    ];

    public $img_fields = [
        "lang_img_obj" => [
            "width"         => "50",
            "height"        => "50",
            "display_label" => "Image",
        ],
    ];


}
