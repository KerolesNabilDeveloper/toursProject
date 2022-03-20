<?php

namespace App\Http\Controllers\admin;

use App\form_builder\CategoriesBuilder;
use App\Http\Controllers\AdminBaseController;
use App\Http\Controllers\traits\CrudTrait;
use App\models\categories_m;
use App\models\tours_m;
use Illuminate\Http\Request;

class CategoriesController extends AdminBaseController
{

    use CrudTrait;

    /** @var categories_m */
    public $modelClass;

    public function __construct()
    {
        parent::__construct();

        $this->setMetaTitle("categories");

        $this->modelClass          = categories_m::class;
        $this->viewSegment         = "categories";
        $this->routeSegment        = "categories";
        $this->builderObj          = new CategoriesBuilder($this->data["all_langs"]);
        $this->primaryKey          = "cat_id";
    }

    public function index(Request $request)
    {

        havePermissionOrRedirect("admin/categories", "show_action");

        $this->data["results"] = categories_m::getParentChildCategories($this->data["all_langs"]->pluck("lang_id")->all());
        $this->data["results"] = $this->data["results"]->groupBy("parent_cat_id");



        return $this->returnView($request, "admin.subviews.$this->viewSegment.show");
    }


    //get parent of cats of lang by using ajax
    public function getParentOfCatsOfLang(Request $request)
    {
        $parent_cats_of_lang=categories_m::getParentOfLang($request->get("lang_id"));
        return $parent_cats_of_lang;
    }

    public function getLangCats(Request $request){

        $allCats = categories_m::getLangCats($request->get("lang_id"));



        $parent_cats=[
            "text"   => array_merge(['select'],$allCats->where("cat_parent_id","=","0")->pluck("cat_name")->all()),
            "values" => array_merge(['0'],$allCats->where("cat_parent_id","=","0")->pluck("cat_id")->all()),
        ];


        $sub_cats=[
            "text"          => [],
            "values"        => [],
            "depend_values" => []
        ];

        foreach ($parent_cats['values'] as $key=>$value)
        {
            $sub_cats['text'][]='select';
            $sub_cats['values'][]='';
            $sub_cats['depend_values'][]=$value;

        }
        $sub_cats=[
            "text"          => array_merge($sub_cats['text'],$allCats->where("cat_parent_id",">","0")->pluck("cat_name")->all()) ,
            "values"        => array_merge($sub_cats['values'],$allCats->where("cat_parent_id",">","0")->pluck("cat_id")->all()) ,
            "depend_values" => array_merge($sub_cats['depend_values'],$allCats->where("cat_parent_id",">","0")->pluck("cat_parent_id")->all()) ,
        ];
        return [

            "parent_cats" =>$parent_cats ,
            "sub_cats" =>$sub_cats,
        ];



    }

//    public function getLangCatsToTour(Request $request){
//
//        $allCats = categories_m::getLangCatsToTour_m($request->get("lang_id"));
//
//
//
//        dd([
//            "text"          => array_merge(['select'],$allCats->where("cat_parent_id",">","0")->pluck("cat_name")->all()),
//            "values"        => array_merge([''],$allCats->where("cat_parent_id",">","0")->pluck("cat_id")->all()),
//            "depend_values" => array_merge([''],$allCats->where("cat_parent_id",">","0")->pluck("cat_parent_id")->all()),
//        ]);
//        return[
//
//            "parent_cats"=>[
//                "text"          =>array_merge(['select'],$allCats->where("cat_parent_id","=","0")->pluck("cat_name")->all()),
//                "values"        =>array_merge([''],$allCats->where("cat_parent_id","=","0")->pluck("cat_id")->all()),
//            ],
//            "sub_cats"=>[
//                "text"          => array_merge(['select'],$allCats->where("cat_parent_id",">","0")->pluck("cat_name")->all()),
//                "values"        => array_merge([''],$allCats->where("cat_parent_id",">","0")->pluck("cat_id")->all()),
//                "depend_values" => array_merge([''],$allCats->where("cat_parent_id",">","0")->pluck("cat_parent_id")->all()),
//            ]
//        ];
//
//
//    }
//

    public function beforeSaveRow(Request $request)
    {
        $request["cat_slug"] = string_safe($request["cat_slug"]);
        return $request;
    }


//    public function getNestedViewOfCatsAvailableLangs()
//    {
//        $cats=categories_m::getAllbyLangs($this->data["all_langs"]);
//
//        $array_sort_categories=array();
//
//        foreach ($cats as $cat)
//        {
//            if($cat->cat_parent_id ==0)
//            {
//                $array_sort_categories[$cat->cat_id]=$cat;
//            }
//            else
//            {
//                $array_sort_categories[$cat->cat_parent_id]->children[]  =$cat;
//            }
//        }
//
//        return $array_sort_categories;
//
//    }

    public function showParentChildCats()
    {
        $showCats=categories_m::getParentChildCategories();

        return $showCats;
    }
    public function showSubsCategoriesParent(Request $request)
    {

        $parent_id=$_GET['parent_id'];

        $allSubsOfParent=categories_m::getAllSubsOfParent($parent_id);

        $this->data['results']=$allSubsOfParent;



        return $this->returnView($request, "admin.subviews.$this->viewSegment.show_subs");

    }
    public function showToursOfCatchild(Request $request)
    {
        $cat_id=$_GET['cat_id'];

        $showTours=tours_m::getTourByCatID($cat_id);

        $this->data['results']=$showTours;

        return $this->returnView($request, "admin.subviews.tours.cat_sub_tours_show");


    }

    public function delete(Request $request)
    {

        categories_m::deleteCatWithChildsWithTour($request->get("item_id"));

        echo json_encode([
            "deleted" => "yes"
        ]);

    }




}
