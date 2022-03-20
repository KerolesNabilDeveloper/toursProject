<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\FrontController;
use App\Jobs\sendEmail;
use App\models\booking_m;
use App\User;
use Illuminate\Http\Request;

class BookingController extends FrontController
{

    public function __construct()
    {
        parent::__construct();
    }


    private function _saving_validation($request)
    {
        $this->data["success"] = "";

        $rules_values =$request->all();
        $rules_itself = [
            'booking_tour_id'=>'required',
            'booking_name'=>'required|string',
            'booking_email'=>'required|email',
            'booking_phone'=>'required|string',
            'booking_departing'=>'required|date',
            'booking_returning'=>'required|date',
            'booking_type'=>'string'
        ];
        $attrs_names  = [];



        return \Validator::make($rules_values, $rules_itself, $attrs_names);

    }

    public function booking(Request $request)
    {
        $check=$this->returnValidatorMsgs($this->_saving_validation($request));
        if ($check!==true)
        {
            return $check;
        }
        booking_m::create([
            'booking_tour_id'       =>clean($request->get('booking_tour_id')),
            'booking_name'          =>clean($request->get('booking_name')),
            'booking_email'         =>clean($request->get('booking_email')),
            'booking_phone'         =>clean($request->get('booking_phone')),
            'booking_departing'     =>date('Y-m-d',strtotime(clean($request->get('booking_departing')))),
            'booking_returning'     =>date('Y-m-d',strtotime(clean($request->get('booking_returning')))),
            'booking_type'          =>clean($request->get('booking_type')),
        ]);

        $adminsEmails=User::getEmailsOfAdmins($this->primary_lang_title);

        (new sendEmail([
            "email"     => $adminsEmails,
            "subject"   => 'new booking request' . " - " . date("Y-m-d H:i"),
            "pure_body" =>  convertArrayKeyAndValueToTable($request->except('_token','undefined'))
        ]))->handle();


        return [
            'msg'=>showContent("booking_keywords.we_received_your_request_successfully")
        ];

    }
}

