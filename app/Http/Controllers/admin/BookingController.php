<?php

namespace App\Http\Controllers\admin;

use App\form_builder\CategoriesBuilder;
use App\Http\Controllers\AdminBaseController;
use App\Http\Controllers\traits\CrudTrait;
use App\models\booking_m;
use App\models\categories_m;
use App\models\contacts_m;
use App\models\tours_m;
use Illuminate\Http\Request;

class BookingController extends AdminBaseController
{

    use CrudTrait;

    /** @var categories_m */
    public $modelClass;

    public function __construct()
    {
        parent::__construct();

        $this->setMetaTitle("booking");

        $this->modelClass          = booking_m::class;
        $this->viewSegment         = "booking";
        $this->routeSegment        = "booking";
        $this->primaryKey          = "booking";
    }

    public function index(Request $request)
    {

        havePermissionOrRedirect("admin/booking", "show_action");

        $this->data["results"] = booking_m::getAllBooking($this->data["all_langs"]->pluck("lang_id")->all());


        return $this->returnView($request, "admin.subviews.booking.show");
    }

    public function showData(Request $request)
    {

        $this->data["results"]=booking_m::getBookingById($_GET['booking_id']);

        return $this->returnView($request, "admin.subviews.booking.showBookingData");
    }




}
