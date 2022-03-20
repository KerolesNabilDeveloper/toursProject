<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\FrontController;
use App\models\pages_m;
use Illuminate\Http\Request;

class PagesController extends FrontController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function showPage(Request $request, $page_slug)
    {

        $page_slug = urldecode(clean($page_slug));

        $getpage =pages_m::getPage($page_slug,$this->primary_lang_id);
        abort_if((!is_object($getpage)), 404);



        $this->data["meta_title"]    = $getpage->page_meta_title;
        $this->data["meta_desc"]     = $getpage->page_meta_desc;
        $this->data["meta_keywords"] = $getpage->page_meta_keywords;

        $this->data["item"]         = $getpage;
        $this->data["meta_image"]   = get_image_from_json_obj($getpage->page_img_obj);



        return $this->returnView($request, getThemeDir().".subviews.pages.page");

    }

    private function getPage(string $page_slug): ?object
    {

        $cond   = [];
        $cond[] = ["pages.hide_page", "=", 0];
        $cond[] = ["pages.page_slug", "=", $page_slug];

        return pages_m::getData([
            "cond"       => $cond,
            "return_obj" => "yes",
        ]);

    }


    public function showNotFoundPage(Request $request)
    {

        return $this->returnView($request, getThemeDir().".subviews.pages.not_found_page");
    }

}
