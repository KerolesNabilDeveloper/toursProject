<?php

namespace App\models;

use App\form_builder\TestimonialsBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class testimonials_m extends Model
{
    use SoftDeletes;

    protected $table        = "testimonials";

    protected $primaryKey   = "testimonial_id";

    protected $dates        = ["deleted_at"];

    protected $fillable     = [
        'testimonial_lang','testimonial_name','testimonial_desc',
        'testimonial_title','testimonial_image','testimonial_image',
        'show_in_menu'
    ];

    static function getData($attrs=[])
    {

        $data    = self::select(\DB::raw("testimonials.*"));
        $data    = ModelUtilities::getTranslateData($data,"testimonials",new TestimonialsBuilder());

        return ModelUtilities::general_attrs($data,$attrs);

    }





}
