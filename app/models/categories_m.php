<?php

namespace App\models;

use App\form_builder\CategoriesBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categories_m extends Model
{
    use SoftDeletes;

    protected $table        = "categories";

    protected $primaryKey   = "cat_id";

    protected $dates        = ["deleted_at"];

    protected $fillable     = [
        'cat_parent_id','lang_cat_id','show_in_menu',
        'cat_slug', 'cat_img_obj','cat_desc',
        'cat_name', 'cat_is_active',
        'cat_meta_title', 'cat_meta_desc',
        'cat_meta_keywords'
    ];

    static function getData($attrs=[])
    {

        $data    = self::select(\DB::raw("categories.*"));
        $data    = ModelUtilities::getTranslateData($data,"categories",new CategoriesBuilder());

        return ModelUtilities::general_attrs($data,$attrs);

    }

    public static function getChildCatsByParentSlug($cat_id)
    {

        $cat_id=Vsi($cat_id);

        $rows=\DB::select("
            select 
                * 
            from  categories  
            where cat_parent_id='{$cat_id}' and
            deleted_at is null
             
        ");

        return collect($rows);

    }

    public static function getAllbyLangsToMenu($langs)
    {

        $langs=Vsi($langs);

        $row=\DB::select("
        
        select
        * 
        from categories 
        where 
        lang_cat_id = '{$langs}'  AND 
        deleted_at is null 
        ORDER BY cat_parent_id,lang_cat_id
        
        ");
        return $row;

    }
    public static function getAllbyLangs($langs)
    {

        $langs=implode(",",$langs->pluck('lang_id')->toArray());

        $row=\DB::select("
        
        select
        * 
        from categories 
        where 
        lang_cat_id in ($langs)  AND !IFNULL(categories.deleted_at,'')
        ORDER BY cat_parent_id,lang_cat_id
        
        ");


        return $row;

    }

    // show categories in backend
    public static function getParentChildCategories($langIds)
    {
        $langIds=implode(",",$langIds);

        $get_parent_child_categories=\DB::select('
          SELECT 
            categories.*,
            IFNULL(categories_parent.cat_id,0) as parent_cat_id,
            categories_parent.cat_name as name_of_parent
          FROM categories 
          LEFT JOIN categories as categories_parent on categories.cat_parent_id =categories_parent.cat_id
          where 
            categories.lang_cat_id in ('.$langIds.') And 
            categories.deleted_at is null 
            
        ');

       return collect($get_parent_child_categories);

    }
    // get parent and child cats to menu work in front
    public static function getParentChildCategoriesToMenu($langIds)
    {
        $get_parent_child_categories=\DB::select('
          SELECT 
            categories.*,
            IFNULL(categories_parent.cat_id,0) as parent_cat_id,
            categories_parent.cat_name as name_of_parent
          FROM categories 
          LEFT JOIN categories as categories_parent 
          on categories.cat_parent_id =categories_parent.cat_id
          where 
          categories.lang_cat_id ='.$langIds.' And 
          categories.show_in_menu=1 and     
          categories_parent.deleted_at is null
        ');

        return collect($get_parent_child_categories);
    }

    static public function getLang()
    {
        $get_lang=\DB::table('langs')->select(
            '
            lang_id','lang_title')->get();
        return $get_lang;
    }

    static public function getLangCats($langId){

        $langId = Vsi($langId);

        $rows = \DB::select("
            select * 
            from categories 
            where lang_cat_id = {$langId} AND !IFNULL(categories.deleted_at,'')
        
        ");

        return collect($rows);

    }

    public static function getParentOfLang($langId)
    {
        $langId=Vsi($langId);

        $row=\DB::select("
            select
             cat_id,cat_name,cat_parent_id
             from categories 
             where lang_cat_id='{$langId}' AND 
             cat_parent_id=0 And 
             cat_is_active=1 AND !IFNULL(categories.deleted_at,'')
        ");

        return collect($row);
    }

    public static function getLangCatsToTour_m($langId){

        $langId=Vsi($langId);
        $row=\DB::select("
           select 
           * 
           from categories 
           where lang_cat_id={$langId}
           AND !IFNULL(categories.deleted_at,'')
           ");


        return collect($row);

    }

    public static function getAllCategoriesToMenu($langId)
    {
        $langId = Vsi($langId);

        $row    = \DB::select("
          select 
          categories.*, catsParent.cat_name, catsParent.cat_id
          from categories 
          left JOIN categories as catsParent
          on categories.cat_id=catsParent.cat_parent_id
          where 
            categories.lang_cat_id='{$langId}' AND 
            categories.cat_is_active=1  AND 
            categories.show_in_menu=1   AND 
            !IFNULL(categories.deleted_at,'')
            order by  categories.cat_parent_id
        ");

        return collect($row)->sortBy('cat_parent_id');

    }

    public static function getAllCategories($langId)
    {
        $langId = Vsi($langId);

        $row    = \DB::select("
          select 
          * 
          from categories 
          where lang_cat_id='{$langId}' AND !IFNULL(categories.deleted_at,'')
        ");

        return collect($row);

    }

    public static function getAllParentCats($langId)
    {
        $langId=Vsi($langId);
        $row=\DB::select("
          select 
          * 
          from categories 
          where cat_parent_id=0 AND 
          lang_cat_id='{$langId}' AND
          deleted_at is null 
          ");

        return collect($row);
    }

    public static function getCatBySlug($parentSlug,$langId)
    {
        $parentSlug=Vsi($parentSlug);
        $langId=($langId);
        $row=\DB::select("
            select
             * 
             from categories 
             where 
             cat_slug='{$parentSlug}'AND
             lang_cat_id='{$langId}' and
             deleted_at is null 
            ");


        if (is_null($row))
        {
            return null;
        }

        return $row[0];

    }

    public static function getChlidsofCat($parent_cat_id)
    {
        $parent_cat_id=Vsi($parent_cat_id);


        $row=\DB::select("
          select 
          * 
          from categories 
          where 
          cat_id='{$parent_cat_id }'AND 
          deleted_at is null
          ");

        return $row;
    }

    public static function getAllSubsOfParent($parentId)
    {
        $parentId=Vsi($parentId);

        $row=\DB::select("
        
            select 
            * 
            from categories
            where 
              categories.cat_parent_id='{$parentId}'AND 
              deleted_at is null
        ");

        return collect($row);

    }

    public static function deleteCatWithChildsWithTour($catId){

        $catId=Vsi($catId);



        $row=\DB::select("
        select 
          cat_id 
        from 
          categories  
        where cat_parent_id='{$catId}'AND 
          deleted_at is null
        ");
        $ids=collect($row)->pluck('cat_id')->all();

        $Ids=implode(",",$ids);

        \DB::select("
        update tours 
        set deleted_at='".date("Y-m-d H:i:s")."'
        where 
            tours.tour_cat_id in('{$Ids}')
            AND !IFNULL(tours.deleted_at,'')
        ");

        \DB::select("
            update categories 
            set deleted_at = '".date("Y-m-d H:i:s")."'
            where 
                cat_id = '{$catId}' OR 
                cat_parent_id = '{$catId}'
                AND !IFNULL(categories.deleted_at,'')
        ");





    }


}
