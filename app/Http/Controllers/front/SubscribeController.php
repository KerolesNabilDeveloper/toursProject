<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\models\subscribes_m;
use Illuminate\Http\Request;


class SubscribeController extends Controller
{


    private function _saving_validation($request)
    {
        $this->data["success"] = "";

        $rules_values =$request->all();
        $rules_itself = [
            'email'=>'required|email|unique:subscribers,email',
        ];
        $attrs_names  = [];



        return \Validator::make($rules_values, $rules_itself, $attrs_names);

    }

    public function newsletter(Request $request)
    {

        $check=$this->returnValidatorMsgs($this->_saving_validation($request));
        if ($check!==true)
        {
            return $check;
        }

        subscribes_m::create([
            'email'    =>clean($request->get('email')),
        ]);

        return [
            'msg'=>showContent("subscribers_content.we_received_your_request_successfully")
        ];

    }


}