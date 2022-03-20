<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\FrontController;
use App\models\categories_m;
use App\models\tours_m;
use Illuminate\Http\Request;

class ToursController extends FrontController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function showParentCategoryPage(Request $request,$parent_slug){

        $parent_cat=categories_m::getCatBySlug($parent_slug,$this->primary_lang_id);

        if(!is_object($parent_cat)||$parent_cat->cat_slug!=$parent_slug)
        {
            return abort('404');
        }

        $this->data['getCats']=categories_m::getChildCatsByParentSlug($parent_cat->cat_id);
        $this->data['parent_cats']=$parent_cat;


        $this->data["meta_title"]    = $parent_cat->cat_meta_title;
        $this->data["meta_desc"]     = $parent_cat->cat_meta_desc;
        $this->data["meta_keywords"] = $parent_cat->cat_meta_keywords;



        return $this->returnView($request,"front.subviews.categories.show_subCats");


    }

    public function showChildCategoryPage(Request $request, string $parentCatSlug, string $childCatSlug)
    {
        $this->data['parentCatSlug'] =$parentCatSlug;
        $this->data['childCatSlug'] =$childCatSlug;

        $parentCat=categories_m::getCatBySlug($parentCatSlug,$this->primary_lang_id);
        if(!is_object($parentCat))
        {
            return abort('404');
        }

        $childCat=categories_m::getCatBySlug($childCatSlug,$this->primary_lang_id);
        if(!is_object($childCat))
        {
            return abort('404');
        }

        if($parentCat->cat_slug!= $parentCatSlug ||$childCat->cat_slug != $childCatSlug){
            return abort(404);
        }

        $this->data['parent_cat']=$parentCat;
        $this->data['child_cat']=$childCat;
        $this->data['all_tours']=tours_m::getAllToursOfCat($childCat->cat_id,$this->primary_lang_id);

        $this->data["meta_title"]    = $childCat->cat_meta_title;
        $this->data["meta_desc"]     = $childCat->cat_meta_desc;
        $this->data["meta_keywords"] = $childCat->cat_meta_keywords;


        return $this->returnView($request,"front.subviews.tours.show_tours");

    }

    public function showTourPage(Request $request, string $parentCatSlug, string $childCatSlug, string $tourSlug){

        $tourObj = tours_m::getTourBySLug($tourSlug,$this->primary_lang_id);

        if (!is_object($tourObj)||$tourObj->parent_cat_slug != $parentCatSlug || $tourObj->child_cat_slug != $childCatSlug)
        {
            return abort('404');
        }

        $someTour =tours_m::getSomeTours($childCatSlug,$limit=6,$this->primary_lang_id);

        $this->data['parentCatSlug']=$parentCatSlug;
        $this->data['childCatSlug']=$childCatSlug;

        $this->data["tour_obj"] = $tourObj;
        $this->data["someTour"] = $someTour;

        $this->data['meta_title']=$tourObj->tour_meta_title;
        $this->data['meta_desc']=$tourObj->tour_meta_desc;
        $this->data['meta_keywords']=$tourObj->tour_meta_keywords;

        return $this->returnView($request,"front.subviews.tours.show_tour");


    }





}
