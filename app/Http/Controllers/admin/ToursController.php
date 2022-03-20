<?php

namespace App\Http\Controllers\admin;

use App\form_builder\ToursBuilder;
use App\Http\Controllers\AdminBaseController;
use App\Http\Controllers\traits\CrudTrait;
use App\models\tours_m;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ToursController extends AdminBaseController
{

    use CrudTrait;

    /** @var tours_m */
    public $modelClass;

    public function __construct()
    {

        parent::__construct();
        $this->setMetaTitle("tours");

        $this->modelClass          = tours_m::class;
        $this->viewSegment         = "tours";
        $this->routeSegment        = "tours";
        $this->builderObj          = new ToursBuilder($this->data["all_langs"]);
        $this->primaryKey          = "id";
    }

    public function index(Request $request)
    {

        havePermissionOrRedirect("admin/tours", "show_action");

        $this->data["results"] = tours_m::getData($this->data["all_langs"]->pluck("lang_id")->all());
        $this->data['all_langs']=$this->getAllLangs();

        return $this->returnView($request, "admin.subviews.$this->viewSegment.show");
    }


    public function beforeSaveRow(Request $request)
    {

        $request["tour_slug"] = string_safe($request["tour_slug"]);

        return $request;

    }
/*
    public function getTours(Request $request){
//
//        $tours_limit = 1;
//        $this->data["tours_limit"] = $tours_limit;
//
//        $this->data["tours_pages"] = $request->get("tours_pages",0);
//        if($request->get("page_num",0) == 0){
//            $this->data["tours_pages"] = tour_m::getPageOfToursAtCategory(1,$tours_limit);
//        }
//
//        $this->data["tours"]      = tours_m::getRowsOfToursAtCategory(1,$tours_limit, $request->get("page_num"));


        //$this->data["tours"]      = tours_m::getDataPaginatedEasy(1);

        return $this->returnView($request,"admin.subviews.$this->viewSegment.getTours");

    }*/


}
