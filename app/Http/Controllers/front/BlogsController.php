<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\FrontController;
use App\models\article_categories_m;
use App\models\pages_m;
use Illuminate\Http\Request;

class BlogsController extends FrontController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {

        $this->data["meta_title"]    = showContent("site_meta.blogs_meta_title");
        $this->data["meta_desc"]     = showContent("site_meta.blogs_meta_desc");
        $this->data["meta_keywords"] = showContent("site_meta.blogs_meta_keywords");

        $this->getPaginatedArticles();

        return $this->returnView($request, getThemeDir().".subviews.blogs.index");

    }

    public function showCategoryArticles(Request $request, $cat_id)
    {

        $cat_id = intval(clean($cat_id));

        $getCategory = $this->getCategory($cat_id);
        abort_if((!is_object($getCategory)), 404);

        $this->data["meta_title"]    = $getCategory->cat_meta_title;
        $this->data["meta_desc"]     = $getCategory->cat_meta_desc;
        $this->data["meta_keywords"] = $getCategory->cat_meta_keywords;

        $this->data["category"]         = $getCategory;

        $this->getPaginatedCategoryArticles($cat_id);

        return $this->returnView($request, getThemeDir().".subviews.blogs.category_articles");

    }

    public function showArticle(Request $request, $page_title, $page_id)
    {

        $page_title = urldecode(clean($page_title));
        $page_id    = intval(clean($page_id));

        $getArticle = $this->getArticle($page_id);
        abort_if((!is_object($getArticle)), 404);

        $this->data["meta_title"]    = $getArticle->page_meta_title;
        $this->data["meta_desc"]     = $getArticle->page_meta_desc;
        $this->data["meta_keywords"] = $getArticle->page_meta_keywords;


        $this->data["item"]         = $getArticle;

        $this->data["meta_image"]   = get_image_from_json_obj($getArticle->page_img_obj);

        $this->getRelatedArticles($page_id, $getArticle->article_cat_id);

        pages_m::find($page_id)->update([
            "page_visited_count" => ($getArticle->page_visited_count + 1)
        ]);

        $this->getRecentArticles($page_id);
        $this->getMostVisitedArticles($page_id);
        $this->getNewArticles($page_id);

        $this->getAllCategories($page_id);

        return $this->returnView($request, getThemeDir().".subviews.blogs.article");

    }

    private function getPaginatedArticles()
    {

        $cond   = [];
        $cond[] = ["pages.page_type", "=", "article"];
        $cond[] = ["pages.page_title", "!=", ""];
        $cond[] = ["pages.hide_page", "=", 0];

        $this->data["results"] = pages_m::getData([
            "cond"     => $cond,
            "order_by" => ["pages.page_order", "asc"],
            "paginate" => 12,
        ]);

    }


    private function getCategory(int $cat_id): ?object
    {

        $cond   = [];
        $cond[] = ["article_categories.cat_id", "=", $cat_id];
        $cond[] = ["article_categories.is_active", "=", 1];

        return article_categories_m::getData([
            "cond"       => $cond,
            "return_obj" => "yes",
        ]);

    }

    private function getPaginatedCategoryArticles(int $cat_id)
    {

        $cond   = [];
        $cond[] = ["pages.page_type", "=", "article"];
        $cond[] = ["pages.page_title", "!=", ""];
        $cond[] = ["pages.hide_page", "=", 0];
        $cond[] = ["pages.article_cat_id", "=", $cat_id];

        $this->data["results"] = pages_m::getData([
            "cond"     => $cond,
            "order_by" => ["pages.page_order", "asc"],
            "paginate" => 12,
        ]);

    }


    private function getArticle(int $page_id): ?object
    {

        $cond   = [];
        $cond[] = ["pages.page_type", "=", "article"];
        $cond[] = ["pages.hide_page", "=", 0];
        $cond[] = ["pages.page_id", "=", $page_id];

        return pages_m::getData([
            "cond"       => $cond,
            "return_obj" => "yes",
        ]);

    }

    private function getRelatedArticles(int $page_id, int $cat_id)
    {

        $cond   = [];
        $cond[] = ["pages.page_type", "=", "article"];
        $cond[] = ["pages.page_title", "!=", ""];
        $cond[] = ["pages.hide_page", "=", 0];
        $cond[] = ["pages.page_id", "<>", $page_id];
        $cond[] = ["pages.article_cat_id", "=", $cat_id];

        $this->data["related_items"] = pages_m::getData([
            "cond"     => $cond,
            "order_by" => ["pages.page_order", "asc"],
            "limit"    => 2,
        ])->all();

    }

    private function getRecentArticles(int $page_id)
    {

        $cond   = [];
        $cond[] = ["pages.page_type", "=", "article"];
        $cond[] = ["pages.page_title", "!=", ""];
        $cond[] = ["pages.hide_page", "=", 0];
        $cond[] = ["pages.page_id", "<>", $page_id];

        $this->data["recent_items"] = pages_m::getData([
            "cond"     => $cond,
            "order_by" => ["pages.page_id", "desc"],
            "limit"    => 3,
        ])->all();

    }

    private function getMostVisitedArticles(int $page_id)
    {

        $cond   = [];
        $cond[] = ["pages.page_type", "=", "article"];
        $cond[] = ["pages.page_title", "!=", ""];
        $cond[] = ["pages.hide_page", "=", 0];
        $cond[] = ["pages.page_visited_count", ">", 0];
        $cond[] = ["pages.page_id", "<>", $page_id];

        $this->data["most_visited_items"] = pages_m::getData([
            "cond"     => $cond,
            "order_by" => ["pages.page_visited_count", "desc"],
            "limit"    => 3,
        ])->all();

    }

    private function getNewArticles(int $page_id)
    {

        $cond   = [];
        $cond[] = ["pages.page_type", "=", "article"];
        $cond[] = ["pages.page_title", "!=", ""];
        $cond[] = ["pages.hide_page", "=", 0];
        $cond[] = ["pages.page_visited_count", "=", 0];
        $cond[] = ["pages.page_id", "<>", $page_id];

        $this->data["new_items"] = pages_m::getData([
            "cond"     => $cond,
            "order_by" => ["pages.page_id", "desc"],
            "limit"    => 3,
        ])->all();

    }

    private function getAllCategories()
    {

        $cond   = [];
        $cond[] = ["article_categories.is_active", "=", 1];

        $this->data["all_cats"] =  article_categories_m::getData([
            "cond"       => $cond,
            "order_by"   => ["article_categories.cat_order", "asc"],
        ])->all();

    }


}
