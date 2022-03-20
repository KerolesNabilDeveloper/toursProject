<?php

namespace App\form_builder;

use App\models\langs_m;

class AdminsBuilder extends FormBuilder
{

    public function __construct($item_id = null)
    {

        if ($item_id != null) {

            $this->normal_fields_custom_attrs["custom_labels"]["password"] .=
                "(Add password. If you want to change the old password)";

        }

        $this->select_fields_data["is_active"] = function () {

            return [
                "text"   => ["OK", "Not active"],
                "values" => ['1', '0'],
            ];

        };

        $this->select_fields_data["allowed_langs"] = function () {

            $allLangs = langs_m::getData();

            return [
                "text"   => $allLangs->pluck("lang_text")->all(),
                "values" => $allLangs->pluck("lang_title")->all(),
            ];

        };


    }

    public $select_fields = [
        "is_active" => [
            "label_name" => "active ؟",
            "class"      => "form-control",
            "grid"       => "col-md-6",
        ],
        "allowed_langs" => [
            "label_name" => "select allowed langs",
            "class"      => "form-control",
            "grid"       => "col-md-6",
            "multiple"   => "multiple",
        ],
    ];

    public $normal_fields = [
        'full_name', 'email', 'password'
    ];

    public $normal_fields_custom_attrs = [

        "default_grid"    => "6",
        "custom_types"    => [
            "email"    => "Email",
            "password" => "Password",
        ],
        "custom_labels"   => [
            "full_name" => "Name",
            "email"     => "Email",
            "password"  => "Password",
        ],
        "custom_required" => [
            "email" => "required",
        ],

    ];

    public $img_fields = [
        "logo_img_obj" => [
            "width"         => "50",
            "height"        => "50",
            "display_label" => "Image",
        ],
    ];


}
