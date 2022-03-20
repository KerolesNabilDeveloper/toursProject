<?php

namespace App\Http\Controllers\admin;

use App\form_builder\ArticlesCategoriesBuilder;
use App\Http\Controllers\AdminBaseController;
use App\Http\Controllers\traits\CrudTrait;
use App\models\article_categories_m;
use Illuminate\Http\Request;

class ArticleCategoriesController extends AdminBaseController
{

    use CrudTrait;

    /** @var article_categories_m */
    public $modelClass;

    public function __construct()
    {
        parent::__construct();

        $this->setMetaTitle("Article Categories");

        $this->modelClass          = article_categories_m::class;
        $this->viewSegment         = "article_categories";
        $this->routeSegment        = "article_categories";
        $this->builderObj          = new ArticlesCategoriesBuilder();
        $this->primaryKey          = "cat_id";
        $this->enableAutoTranslate = true;
    }

    public function index(Request $request)
    {

        havePermissionOrRedirect("admin/article_categories", "show_action");

        $this->data["results"] = $this->modelClass::getData([
            "order_by"              => ["cat_order", "asc"],
            "get_only_current_lang" => true
        ]);

        return $this->returnView($request, "admin.subviews.$this->viewSegment.show");
    }

    public function beforeDoAnythingAtSave(Request $request, $item_id)
    {

        havePermissionOrRedirect("admin/article_categories", $item_id == null ? "add_action" : "edit_action");

    }

    public function beforeAddNewRow(Request $request)
    {
        $request["cat_order"] = $this->modelClass::where("parent_id", 0)->count();
        $request["is_active"] = 1;

        return $request;
    }


}
