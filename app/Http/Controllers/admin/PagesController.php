<?php

namespace App\Http\Controllers\admin;

use App\form_builder\PagesBuilder;
use App\Http\Controllers\AdminBaseController;
use App\Http\Controllers\traits\CrudTrait;
use App\models\pages_m;
use Illuminate\Http\Request;

class PagesController extends AdminBaseController
{

    use CrudTrait;

    /** @var pages_m */
    public $modelClass;

    public function __construct()
    {
        parent::__construct();

        $this->setMetaTitle("pages");

        $this->modelClass          = pages_m::class;
        $this->viewSegment         = "pages";
        $this->routeSegment        = "pages";
        $this->builderObj          = new PagesBuilder($this->data["all_langs"]);
        $this->primaryKey          = "page_id";
    }

    public function index(Request $request)
    {

        havePermissionOrRedirect("admin/pages", "show_action");

        $cond   = [];
        $this->data["results"] = $this->modelClass::getDataPageAdmin(
            $this->data["all_langs"]->pluck('lang_id')->all()
        );

        return $this->returnView($request, "admin.subviews.$this->viewSegment.show");
    }






}
