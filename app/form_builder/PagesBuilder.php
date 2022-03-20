<?php

namespace App\form_builder;


class PagesBuilder extends FormBuilder
{
    public function __construct($allLangs = [])
    {
        $this->select_fields_data["page_lang_id"] = function() use ($allLangs){
            return [
                "text"   => $allLangs->pluck("lang_text")->all(),
                "values" => $allLangs->pluck("lang_id")->all(),
            ];
        };
        $this->select_fields_data["hide_page"] = function () {
            return [
                "text"   => ["no", "yes"],
                "values" => ["0", "1"],
            ];
        };
        $this->select_fields_data["show_page_on_menu"] = function () {
            return [
                "text"   => ["no", "yes"],
                "values" => ["0", "1"],
            ];
        };
    }

    public $select_fields = [
        "page_lang_id" => [
            "label_name" => "select lang",
            "class"      => "form-control",
            "grid"       => "col-md-4",
        ],
        "show_page_on_menu" => [
            "label_name" => "show in menu ?",
            "class"      => "form-control",
            "grid"       => "col-md-4",
        ],
        "hide_page"      => [
            "label_name" => "hidden ?",
            "class"      => "form-control select_2_primary",
            "grid"       => "col-md-4",
        ]
];
    public $normal_fields = [
        'page_title','page_slug','page_body',
        'page_body_paragraph_one',
        'page_body_paragraph_two',
        'page_body_paragraph_three',
        'page_meta_title',
        'page_meta_desc',
        'page_meta_keywords',
    ];

    public $normal_fields_custom_attrs = [
        "default_required" => "",
        "default_grid"     => "4",
        "custom_labels"    => [
        ],
        "custom_required"  => [
        ],
        "custom_types"     => [
            "page_meta_title"    => "textarea",
            "page_meta_desc"     => "textarea",
            "page_meta_keywords" => "textarea",

        ],
        "custom_classes"   => [
            "page_body"          => "ckeditor",
        ],
        "custom_grid"      => [
            'page_meta_title'    => "4",
            'page_meta_desc'     => "4",
            'page_meta_keywords' => "4",
            "page_body"          => "12",
            "page_title"         => "6",
            "page_slug"          => "6",
        ],
    ];
    public $img_fields = [
        "page_img_obj"       => [
            "width"          => "",
            "height"         => "",
            "need_alt_title" => "",
            "display_label"  => "Upload Cover Image",
        ],
        "page_body_img_one_obj"       => [
            "width"          => "",
            "height"         => "",
            "need_alt_title" => "",
            "display_label"  => "Upload Main Image Content",
        ],
        "page_body_img_two_obj"       => [
            "width"          => "",
            "height"         => "",
            "need_alt_title" => "",
            "display_label"  => "Upload Second Image Content ",
        ],
    ];
}
