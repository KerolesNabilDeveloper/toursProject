<?php

namespace App\models;

use App\form_builder\ToursBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tours_m extends Model
{
    use SoftDeletes;

    protected $table        = "tours";

    protected $primaryKey   = "id";

    protected $dates        = ["deleted_at"];

    protected $fillable     = [
        'lang_tour','tour_cat_id','tour_location', 'tour_slug', 'tour_name','tour_number_of_people', 'tour_type',
        'tour_title', 'tour_duration', 'tour_short_desc', 'tour_description', 
        'tour_inclusions', 'tour_exclusions', 'tour_sort', 'tour_meta_title', 'tour_meta_desc',
        'tour_meta_keywords', 'tour_price', 'tour_discount', 'tour_show_home', 'tour_main_img_obj',
        'tour_second_img_obj', 'tour_cover_img_obj', 'tour_slider_obj',
        'tour_itinerary',
    ];

    static function getDataPaginatedEasy($cat_id){

        $cat_id = Vsi($cat_id);

        return self::paginate(1);

    }

    // get some tours in show tour
    public static function getSomeTours($childCatSlug,$limit,$langId)
    {
        $childCatSlug=Vsi($childCatSlug);
        $langId=Vsi($langId);
        $limit=Vsi($limit);

        $tour_obj=\DB::select("

          select 
          * 
          from categories 
          where 
            cat_slug ='{$childCatSlug}' and 
            deleted_at is null and 
            lang_cat_id='{$langId}'
          
           ");
        if(!isset($tour_obj[0]->cat_id))
        {
            return null;
        }
       $idOfSubCat=$tour_obj[0]->cat_id;

        $row=\DB::select("
            select 
             tour_slug,tour_title,tour_price,
             tour_number_of_people,tour_main_img_obj,
             tour_discount
             from tours 
             where tour_cat_id='{$idOfSubCat}'and
             deleted_at is null  
             ORDER BY RAND()
             limit $limit
        
        ");
        return $row;
    }

    // get tours in index
    public static function getToursInMenu($langId)
    {

        $langId=Vsi($langId);

        $row=\DB::select("
        
            select 
            tours.*,
            child_cat.cat_slug as 'child_cat_slug' ,
            parent_cat.cat_slug as 'parent_cat_slug'     
            from tours 
            inner join categories as child_cat on tours.tour_cat_id=child_cat.cat_id
            inner join categories as parent_cat on child_cat.cat_parent_id=parent_cat.cat_id
            where 
            lang_tour='{$langId}'and 
            tour_show_home=1 and 
            tours.deleted_at  is null  
        ");

        return collect($row);
    }

    #region HardMode

    static function getPageOfToursAtCategory($cat_id,$limit){

        $cat_id = Vsi($cat_id);

        $row=\DB::select("
            select
            count(*) as tours_count
            from tours
             where 
            deleted_at is null
        ");

        if(!isset($row[0])){
            return 0;
        }

        $tours_count = $row[0]->tours_count;

        return ceil($tours_count / $limit);

    }

    static function getRowsOfToursAtCategory($cat_id,$limit,$pageNum=0){

        $cat_id = Vsi($cat_id);
        $offset = $pageNum*$limit;

        $rows=\DB::select("
            select
            *
            from tours
            limit {$limit}
            offset {$offset}
        ");


        return collect($rows);

    }

    #endregion

    static function getData($langIds)
    {
        $langIds=implode(",",$langIds);

        $rows = \DB::select("  
            select 
            *
            from tours
            where 
              tours.lang_tour in ($langIds) and 
              deleted_at is null 
        
        ");
        return collect($rows);
    }

    public static function getTourBySLug($slug,$langId){

        $slug = Vsi($slug);
        $langId=Vsi($langId);

        $rows = \DB::select("
            select 
              tours.*,
              parent_cat.cat_slug as 'parent_cat_slug',
              parent_cat.cat_name as 'name_parent',
              child_cat.cat_name  as 'name_child',
              child_cat.cat_slug  as 'child_cat_slug'
            from tours
            inner join categories as child_cat on child_cat.cat_id = tours.tour_cat_id
            inner join categories as parent_cat on child_cat.cat_parent_id = parent_cat.cat_id
            where 
            tours.tour_slug = '{$slug}' AND
            lang_tour ='{$langId}'  and
            child_cat.deleted_at is null
            
        
        ");

        if(!isset($rows[0])){
            return null;
        }

        return $rows[0];

    }

    public static function getAllToursOfCat($cat_id,$langId)
    {

        $langId=Vsi($langId);
        $row=\DB:: select("
            select
            *
            from tours
            where 
            tour_cat_id='{$cat_id}' AND
            lang_tour='{$langId}'  AND
            deleted_at is null
        ");

        return $row;
    }

    public static function getTourByCatID($catID)
    {
        $catID=Vsi($catID);

        $row=\DB::select("
        select 
              * 
        from tours  
        where 
          tour_cat_id='{$catID}' and 
          deleted_at is null 
        ");

        return collect($row);


    }



}
