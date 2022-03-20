<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserBaseController extends FrontController
{

    public function returnView(Request $request, $viewPath, $main_dir = "user")
    {

        return parent::returnView($request,$viewPath,$main_dir);

    }

}
