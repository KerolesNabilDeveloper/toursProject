<?php

namespace App\models;

use App\form_builder\LanguagesBuilder;
use Illuminate\Database\Eloquent\SoftDeletes;

class langs_m extends \Eloquent
{

    use SoftDeletes;

    protected $table = "langs";

    protected $primaryKey = "lang_id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'lang_title', "lang_text", "lang_country_code", "lang_is_rtl", "lang_is_active", "lang_img_obj"
    ];

    static function getData()
    {

        $rows = \DB::select("
            select 
              langs.* 
            from langs
        ");

        return collect($rows);

    }

    static function getDataByLangTitles($langTitles)
    {

        if(!is_array($langTitles) || count($langTitles) == 0){
            return collect([]);
        }

        $langTitles = "'".implode("','",$langTitles)."'";

        $rows = \DB::select("
            select 
              langs.* 
            from langs 
            where lang_title in ({$langTitles})
        ");

        return collect($rows);

    }



}
