<?php

namespace App\Http\Controllers\admin;

use App\form_builder\CategoriesBuilder;
use App\Http\Controllers\AdminBaseController;
use App\Http\Controllers\traits\CrudTrait;
use App\models\categories_m;
use App\models\contacts_m;
use App\models\tours_m;
use Illuminate\Http\Request;

class ContactController extends AdminBaseController
{

    use CrudTrait;

    /** @var categories_m */
    public $modelClass;

    public function __construct()
    {
        parent::__construct();

        $this->setMetaTitle("contact_us");

        $this->modelClass          = contacts_m::class;
        $this->viewSegment         = "contact_us";
        $this->routeSegment        = "contact_us";
        $this->primaryKey          = "contact_id";
    }

    public function index(Request $request)
    {

        havePermissionOrRedirect("admin/categories", "show_action");

        $this->data["results"] = contacts_m::getAllContact($this->data["all_langs"]->pluck("lang_id")->all());


        return $this->returnView($request, "admin.subviews.contact.show");
    }




}
