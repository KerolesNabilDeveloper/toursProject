<?php

namespace App\Http\Controllers\admin;

use App\btm_form_helpers\site_content;
use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;

class DashboardController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $this->setMetaTitle("Dashboard");

        site_content::general_get_content(
            $this->primary_lang_title,
            ["array_inputs"]
        );

        $this->data["array_inputs"] = $GLOBALS["site_content"]["array_inputs"];

        return $this->returnView($request,"admin.subviews.index");
    }

}
