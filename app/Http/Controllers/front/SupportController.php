<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\FrontController;
use App\Jobs\SendNotificationToAdmins;
use App\models\support_messages_m;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportController extends FrontController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {

        $this->data["meta_title"]    = showContent("site_meta.support_meta_title");
        $this->data["meta_desc"]     = showContent("site_meta.support_meta_desc");
        $this->data["meta_keywords"] = showContent("site_meta.support_meta_keywords");

        return $this->returnView($request, getThemeDir().".subviews.support.index");

    }

    private function sendNotificationsToAdmins($submitData){


        if(isset($submitData["user_id"])){
            unset($submitData["user_id"]);
        }

        dispatch(
            (new SendNotificationToAdmins([
                "notification_type" => "support_requests",
                "title"             => "New Support Request",
                "body"              => "New Support Request",
                "email_body"        => convertArrayKeyAndValueToTable($submitData),
                "url"               => "admin/support_messages",
            ]))->onQueue("not_important_queue")
        );

    }

    public function sendRequest(Request $request)
    {
        $current_user = $this->data["current_user"];

        $validator = $this->supportValidation($request);
        $validator = $this->returnValidatorMsgs($validator);
        if ($validator !== true){
            return $validator;
        }

        if (checkRecaptcha($request) !== true) {
            return [
                "error"          => showContent("support.you_must_verify_that_you_are_not_robot"),
                "reload_captcha" => true,
            ];
        }

        $data = clean($request->all());

        $submitData = [
            "email"     => $data["email"],
            "full_name" => $data["full_name"],
            "message"   => $data["message"],
            "phone"     => ($data["phone_code"]." ".$data["phone"]),
        ];

        if (is_object($current_user) && !in_array($current_user->user_type, ["admin", "dev"]))
        {
            $submitData["user_id"] = $this->user_id;
        }

        support_messages_m::create($submitData);

        $this->sendNotificationsToAdmins($submitData);

        return $this->returnMsgWithRedirection(
            $request,
            langUrl("/"),
            showContent("support.your_message_has_been_send_successfully")
        );

    }

    public function supportValidation(Request $request)
    {

        $messages = [
            "email.required"      => showContent('home_content.email_is_requried'),
            "email.email"         => showContent('home_content.email_is_not_valid'),
            "full_name.required"  => showContent('support.full_name_is_requried'),
            "message.required"    => showContent('support.message_is_requried'),
            "phone_code.required" => showContent('support.phone_code_is_requried'),
            "phone.required"      => showContent('support.phone_is_requried'),
            "phone.numeric"       => showContent('support.phone_should_be_number'),
        ];

        $rules = [
            'email'      => 'required|email',
            'full_name'  => 'required',
            'message'    => 'required',
            'phone_code' => 'required',
            'phone'      => 'required|numeric',
        ];

        return Validator::make(clean($request->all()), $rules, $messages);

    }


}
