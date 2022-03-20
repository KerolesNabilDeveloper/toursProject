<?php

namespace App\Http\Controllers\admin;

use App\form_builder\LanguagesBuilder;
use App\Http\Controllers\AdminBaseController;
use App\Http\Controllers\traits\CrudTrait;
use App\models\langs_m;
use Illuminate\Http\Request;

class LanguagesController extends AdminBaseController
{

    use CrudTrait;

    /** @var langs_m */
    public $modelClass;

    public function __construct()
    {
        parent::__construct();

        $this->setMetaTitle("langs");

        $this->modelClass          = langs_m::class;
        $this->viewSegment         = "langs";
        $this->routeSegment        = "langs";
        $this->builderObj          = new LanguagesBuilder();
        $this->primaryKey          = "lang_id";
    }

    public function index(Request $request)
    {

        havePermissionOrRedirect("admin/languages", "show_action");

        $cond   = [];

        $this->data["results"] = $this->modelClass::getData([
            "cond"     => $cond,
        ]);

        return $this->returnView($request, "admin.subviews.$this->viewSegment.show");
    }



}
