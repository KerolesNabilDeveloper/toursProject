<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminBaseController;
use App\User;
use Illuminate\Http\Request;

class UsersController extends AdminBaseController
{


    public function __construct()
    {

        parent::__construct();

        $this->setMetaTitle("Users");
    }

    public function index(Request $request)
    {

        havePermissionOrRedirect("admin/users", "show_users");

        $this->data["results"] = User::getUsers([
            "free_conds" => [
                "users.user_type in ('user')"
            ],
            "order_by"     => ["users.user_id", "desc"],
            "paginate" => 50
        ]);


        $this->data["results"] = $this->data["results"]->appends('load_inner',null);

        return $this->returnView($request, "admin.subviews.users.show");
    }

}
