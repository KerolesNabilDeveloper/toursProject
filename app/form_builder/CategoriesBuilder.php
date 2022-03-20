<?php

namespace App\form_builder;

use App\models\categories_m;
use App\models\langs_m;

class CategoriesBuilder extends FormBuilder
{

    function __construct($allLangs = [])
    {
        $this->select_fields_data["lang_cat_id"] =function ()use ($allLangs) {

            return [
                "text"   => $allLangs->pluck("lang_text")->all(),
                "values" => $allLangs->pluck("lang_id")->all(),
            ];
        };

        $this->select_fields_data["cat_parent_id"] = function () {
            return [
                "text"   => [],
                "values" => []
            ];
        };

        $this->select_fields_data["cat_is_active"] = function () {
            return [
                "text"   => ["yes", "no"],
                "values" => ["1", "0"],
            ];

        };
        $this->select_fields_data["show_in_menu"] = function () {

            return [
                "text"   => ["yes", "no"],
                "values" => ["1", "0"],
            ];

        };

    }

    public  $normal_fields=[
        'cat_slug','cat_name',
        'cat_meta_title', 'cat_meta_desc',
        'cat_desc', 'cat_meta_keywords'
    ];

    public  $normal_fields_custom_attrs=[
        "default_required"=>"",
        "default_grid"=>"12",
        "custom_labels"=>[
            "cat_slug"=>"slug",

        ],
        "custom_required"=>[],
        "custom_types"=>[
            'cat_slug'       =>"string",
            "cat_desc"       => "textarea",

        ],
        "custom_classes"=>[
            'cat_slug'       =>"form-control",
            'cat_desc'       =>'form-control ckeditor',
        ],
        "custom_grid"=>[],
    ];


    public $select_fields = [
        "lang_cat_id"       => [
            "label_name" => "lang",
            "class"      => "form-control select_primary  selected_cat_parent_id  "  ,
            "grid"       => "col-md-4",
        ],
        "cat_is_active"     => [
            "label_name" => "is active ?",
            "class"      => "form-control select_primary",
            "grid"       => "col-md-4",
        ],
        "show_in_menu"      => [
            "label_name" => "show in menu",
            "class"      => "form-control select_primary",
            "grid"       => "col-md-4",
        ],
        "cat_parent_id"     => [
            "label_name" => "parent or child",
            "class"      => "form-control select_primary  cat_parent_id",
            "grid"       => "col-md-12",
        ],




    ];

    public  $img_fields=[
        "cat_img_obj"=>[
            "width"=>"",
            "height"=>"",
            "need_alt_title"=>"no",
            "display_label"=>"Upload category image",
        ],
    ];


}
