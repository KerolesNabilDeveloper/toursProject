<?php

namespace App\Http\Controllers\admin;

use App\form_builder\ArticleBuilder;
use App\Http\Controllers\AdminBaseController;
use App\Http\Controllers\traits\CrudTrait;
use App\models\article_m;
use Illuminate\Http\Request;

class ArticleController extends AdminBaseController
{

    use CrudTrait;

    /** @var article_m */
    public $modelClass;

    public function __construct()
    {
        parent::__construct();

        $this->setMetaTitle("articles");

        $this->modelClass          = article_m::class;
        $this->viewSegment         = "articles";
        $this->routeSegment        = "articles";
        $this->builderObj          = new ArticleBuilder();
        $this->primaryKey          = "article_id";
    }

    public function index(Request $request)
    {
        havePermissionOrRedirect("admin/article", "show_action");

        $this->data["results"] = $this->modelClass::getData([
            "cond"     => [],
        ]);

        return $this->returnView($request, "admin.subviews.$this->viewSegment.show");
    }



}
