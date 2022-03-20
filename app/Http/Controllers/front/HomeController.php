<?php

namespace App\Http\Controllers\front;

use App\btm_form_helpers\site_content;
use App\Http\Controllers\FrontController;
use App\models\categories_m;
use App\models\tours_m;
use Illuminate\Http\Request;

class HomeController extends FrontController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {

        $this->data['tours_in_index']=tours_m::getToursInMenu($this->primary_lang_id);

        $this->data['meta_title']=showContent('meta_content.index_meta_title');
        $this->data['meta_desc']=showContent('meta_content.index_meta_desc');
        $this->data['meta_keywords']=showContent('meta_content.index_meta_keywords');

        return $this->returnView($request, "front.subviews.index.index");

    }

}
