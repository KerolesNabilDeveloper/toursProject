<?php

namespace App\Http\Controllers;

use App\models\push_tokens\push_tokens_m;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class logout extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {

        \Auth::logout();

        \Session::flush();

        return Redirect::to(pureLangUrl("/"))->send();

    }

}
