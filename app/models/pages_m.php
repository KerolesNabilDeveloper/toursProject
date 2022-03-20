<?php

namespace App\models;

use App\form_builder\PagesBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pages_m extends Model
{
    use SoftDeletes;

    protected $table = "pages";

    protected $primaryKey = "page_id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'page_lang_id','page_body_img_one_obj',
        'page_body_img_two_obj','page_body_paragraph_one',
        'page_body_paragraph_two','page_body_paragraph_three',
        'page_slug','page_img_obj',
        'page_title','page_body','hide_page','show_page_on_menu',
        'page_meta_title','page_meta_desc','page_meta_keywords',
    ];

    static function getData($attrs)
    {

        $results = self::select(\DB::raw("
            pages.*
        "));

        $results = ModelUtilities::getTranslateData($results, "pages", new PagesBuilder());

        return ModelUtilities::general_attrs($results, $attrs);

    }

    public static function getMenuPages($langId)
    {
        $langId=Vsi($langId);


        $row=\DB::select("
            select 
            * 
            from pages  
            where 
                show_page_on_menu=1 and
                hide_page=0         and 
                page_lang_id={$langId} and
                deleted_at is null
        ");



        return collect($row);

    }

    public static function getPage($pageSlug,$langId)
    {
        $pageSlug=Vsi($pageSlug);
        $langId=Vsi($langId);

        $row=\DB::select("
        
            select
              *
            from pages  
            where 
              page_slug='{$pageSlug}' and 
              page_lang_id='{$langId}'
        ");

        if(!isset($row[0]))
        {
            return null;
        }

        return $row[0];
    }
    // show data in backend in show
    public static function getDataPageAdmin($langIds)
    {

        $langIds=Vsi($langIds);
        $langIds=implode(",",$langIds);

        $rows=\DB::select("
        
        select 
            * 
        from pages
        where 
        page_lang_id in ({$langIds}) and 
        deleted_at is null 
        
        ");




        return collect($rows);
    }


}
