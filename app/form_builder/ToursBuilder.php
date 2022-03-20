<?php

namespace App\form_builder;

use App\models\categories_m;
use App\models\tours_m;

class ToursBuilder extends FormBuilder
{


    function __construct()
    {

        $this->select_fields_data["tour_show_home"] = function () {

            return [
                "text"   => ["yes", "no"],
                "values" => ["1", "0"],
            ];

        };

        $this->select_fields_data["tour_type"] = function () {

            return [
                "text"   => ["tour", "package"],
                "values" => ["tour", "package"],
            ];

        };

    }
    public $select_fields = [

        "tour_show_home"=>
            [
                "show_home"  => "show ?",
                "class"      => "form-control select_2_primary",
                "grid"       => "col-md-6",
            ],
        "tour_type"=>
            [
                "type"       =>"tour or package",
                "class"      => "form-control select_2_primary",
                "grid"       => "col-md-6",
            ]
    ];


    public  $normal_fields=[
        'tour_slug', 'tour_name','tour_number_of_people','tour_location',
        'tour_title', 'tour_duration', 'tour_short_desc', 'tour_description',
        'tour_inclusions', 'tour_exclusions', 'tour_meta_title', 'tour_meta_desc',
        'tour_meta_keywords', 'tour_price', 'tour_discount'
    ];

    public  $normal_fields_custom_attrs=[
        "default_required"=>"",
        "default_grid"=>"6",
        "custom_labels"=>[
        ],
        "custom_required"=>[
        'tour_slug'                 =>'required',
        'tour_name'                 =>'required',
        'tour_title'                =>'required',
        'tour_duration'             =>'required',
        'tour_meta_title'           =>'required',
        'tour_meta_desc'            =>'required',
        'tour_meta_keywords'        =>'required',
        ],
        "custom_types"=>[
            'tour_duration'         =>'number',
            'tour_price'            =>'number',
            'tour_discount'         =>'number',
            "tour_inclusions"       => "textarea",
            "tour_exclusions"       => "textarea",
        ],
        "custom_classes"=>[
            'tour_slug'=>"form-control ",
            'tour_inclusions'       =>'form-control ckeditor',
            'tour_exclusions'       =>'form-control ckeditor'
        ],
        "custom_grid"=>[

                'tour_inclusions'    => "12",
                'tour_exclusions'    => "12",


        ],
    ];

    public  $img_fields=[
        "tour_main_img_obj"=>[
            "width"=>"",
            "height"=>"",
            "need_alt_title"=>"yes",
            "display_label"=>"Upload Main image",
        ],
        "tour_second_img_obj"=>[
            "width"=>"",
            "height"=>"",
            "need_alt_title"=>"yes",
            "display_label"=>"Upload Second image",
        ],
        "tour_cover_img_obj"=>[
            "width"=>"",
            "height"=>"",
            "need_alt_title"=>"yes",
            "display_label"=>"Upload Cover image",
        ]
    ];

    public  $slider_fields=[
        "tour_slider_obj"=>[
            "imgs_limit" => 15,
            "width"=>"0",
            "height"=>"0",
            "need_alt_title"=>"yes",
            "display_label"=>"tour slider",
        ],
    ];


  public $array_fields = [

        'tour_itinerary' => [
            'label'         => 'tour itinerary',
            'fields'        => ['tour_itinerary_title', 'tour_itinerary_body'],
            "default_grid"  => "12",
            "custom_labels" => [
                "tour_itinerary_title"          => "title",
                "tour_itinerary_body"           => "body",
            ],
            "custom_types"  => [
                "tour_itinerary_title"          => "textarea",
                "tour_itinerary_body"           => "textarea",
            ],
            "custom_classes"  => [
                "tour_itinerary_body"               => "my_ckeditor",
            ],


        ]

    ];



}
