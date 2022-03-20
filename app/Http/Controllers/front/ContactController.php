<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\FrontController;
use App\Jobs\sendEmail;
use App\models\contacts_m;
use App\User;
use Illuminate\Http\Request;

class ContactController extends FrontController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getContact(Request $request)
    {

        $this->data['meta_title']=showContent('meta_content.contact_meta_title');
        $this->data['meta_desc']=showContent('meta_content.contact_meta_desc');
        $this->data['meta_keywords']=showContent('meta_content.contact_meta_keywords');

        return $this->returnView($request,"front.subviews.contact.contact");

    }

    private function _saving_validation($request)
    {

        $this->data["success"] = "";

        $rules_values =$request->all();
        $rules_itself = [
            'contact_name'      =>'required|string',
            'contact_lang_id'   =>'required|string',
            'contact_number'    =>'required|integer',
            'contact_email'     =>'required|email',
            'contact_message'   =>'string',
        ];
        $attrs_names  = [];



        return \Validator::make($rules_values, $rules_itself, $attrs_names);

    }

    public function saveMessage(Request $request)
    {


        $check=$this->returnValidatorMsgs($this->_saving_validation($request));
        if ($check!==true)
        {
            return $check;
        }

        contacts_m::create([
            'contact_lang_id'      =>clean($request->get('contact_lang_id')),
            'contact_name'            =>clean($request->get('contact_name')),
            'contact_number'          =>clean($request->get('contact_number')),
            'contact_email'           =>clean($request->get('contact_email')),
            'contact_message'         =>clean($request->get('contact_message')),

        ]);

        $adminsEmails=User::getEmailsOfAdmins($this->primary_lang_title);




        (new sendEmail([
            "email"     => $adminsEmails,
            "subject"   => 'new contact us request' . " - " . date("Y-m-d H:i"),
            "pure_body" =>  convertArrayKeyAndValueToTable($request->except('_token','undefined'))
        ]))->handle();




        return [
            'msg'=>showContent("contact_content.we_received_your_request_successfully")
        ];

    }



}
