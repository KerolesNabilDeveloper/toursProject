<?php

namespace App\Http\Controllers\front;

use App\Helpers\MessageHandleHelper;
use App\Http\Controllers\FrontController;
use App\Jobs\sendSMS;
use App\models\push_tokens\push_tokens_m;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends FrontController
{

    public $messageHandler;

    public function __construct()
    {
        parent::__construct();

        $this->messageHandler = new MessageHandleHelper();

    }

    private function redirectBasedOnUserType(Request $request, string $userType){

        $redirectLink = "{$userType}/dashboard";

        if ($userType == "dev") {
            $redirectLink = url("admin/dashboard");
        }

        return $this->returnMsgWithRedirection($request,$redirectLink,"",true);

    }


        //done
    public function loginValidation(Request $request)
    {

        $messages = [
            'field.required'    => showContent("general_keywords.login_field_is_required"),
            'password.required' => showContent("general_keywords.password_is_required"),
        ];

        $rules = [
            'field'    => 'required',
            'password' => 'required',
        ];

        return Validator::make(clean($request->all()), $rules, $messages);

    }

    //done
    private function afterLogin(Request $request, object $user)
    {

        $allHeaders               = clean($request->headers->all());
        $allHeaders["ip_address"] = clean($request->ip());

        $data['user_id'] = $user->user_id;

        $get_user = User::getUserProfile($user->user_id);

        if ($get_user->user_is_blocked) {
            Auth::logout();
            return $this->messageHandler->getJsonBadRequestErrorResponse(showContent("authentication.admin_blocked_you_from_login"));
        }

        $request->session()->put('password_changed_at', $user->password_changed_at);

        $request->session()->put('this_user_id', $user->user_id);
        $request->session()->put('this_user_type', $user->user_type);
        $request->session()->save();

        return $this->messageHandler->postJsonSuccessResponse("", $get_user->toArray());

    }

    //done
    public function loginMethod(Request $request): object
    {

        $data       = clean($request->all());
        $loginField = $data["field"];
        $password   = $data['password'];

        $loginFieldType = "username";
        if (filter_var($loginField, FILTER_VALIDATE_EMAIL)) {
            $loginFieldType = "email";
        }
        elseif (preg_match("/^[0-9]{9}$/", $loginField)) {
            $loginFieldType = "phone";
        }

        $check = Auth::attempt([
            'provider'          => "site",
            "{$loginFieldType}" => $loginField,
            'password'          => $password,
        ]);

        if (!$check) {
            return $this->messageHandler->getJsonBadRequestErrorResponse(showContent("authentication.invalid_email_or_password"));
        }

        return $this->afterLogin($request, Auth::user());

    }



    public function login(Request $request)
    {

        $this->data["meta_title"]    = showContent("site_meta.login_meta_title");
        $this->data["meta_desc"]     = showContent("site_meta.login_meta_desc");
        $this->data["meta_keywords"] = showContent("site_meta.login_meta_keywords");

        if (is_object(Auth::user()) && Auth::user()->is_active) {
            return $this->redirectBasedOnUserType($request, Auth::user()->user_type);
        }

        if($request->method()=="POST"){


            $validator = $this->loginValidation($request);
            $validator = $this->returnValidatorMsgs($validator);
            if ($validator !== true){
                return $validator;
            }

            $loginData = $this->loginMethod($request)->content();

            $handleApi = $this->handleApiResponse($request, $loginData);
            if($handleApi !== true){
                return $handleApi;
            }

            $loginData = $this->getApiResponseData($loginData);


            return $this->redirectBasedOnUserType($request,$loginData->user_type);

        }


        return $this->returnView($request,getThemeDir().".subviews.authentication.login");
    }

    public function loginWithSocial(Request $request,string $social){

        if(!in_array($social,["facebook","google"]))return abort(404);

        return \Socialite::driver($social)->redirect();

    }

    public function socialCallback(Request $request,string $social){

        if(!in_array($social,["facebook","google"]))return abort(404);

        try {
            $user = \Socialite::driver($social)->user();
        }
        catch (\Exception $exception) {
            return redirect($this->data["lang_url_segment"] . "login")->with([
                "msg" => "<div class='alert alert-info'>" . showContent("general_keywords.please_try_again") . "</div>"
            ]);
        }


        $request["provider"]  = $social;
        $request["api_id"]    = $user->getId();
        $request["full_name"] = $user->getName();
        $request["email"]     = $user->getEmail();

        $validator = $this->service->socialLoginValidation($request);
        $validator = $this->returnValidatorMsgs($validator);
        if ($validator !== true) {
            return $validator;
        }

        $loginData = $this->service->socialLogin($request)->content();

        $handleApi = $this->handleApiResponse($request, $loginData);
        if ($handleApi !== true) {
            return $handleApi;
        }


        return redirect()->intended(pureLangUrl("/"));


    }


    public function registerAsUser(Request $request){

        $this->data["meta_title"]    = showContent("site_meta.user_registration_meta_title");
        $this->data["meta_desc"]     = showContent("site_meta.user_registration_meta_desc");
        $this->data["meta_keywords"] = showContent("site_meta.user_registration_meta_keywords");

        if($request->method()=="POST"){

            if($request->get("password") != $request->get("password_confirmation")){
                return [
                    "error" => showContent("authentication.your_password_is_mismatched")
                ];
            }

            if (checkRecaptcha($request) !== true) {
                return [
                    "error" => showContent("support.you_must_verify_that_you_are_not_robot")
                ];
            }

            $validator = $this->service->registerAsUserValidation($request);
            $validator = $this->returnValidatorMsgs($validator);
            if ($validator !== true){
                return $validator;
            }

            $request->headers->set('accept-language', $this->primary_lang_title);

            $apiData = $this->service->registerAsUser($request)->content();

            $handleApi = $this->handleApiResponse($request, $apiData);
            if($handleApi !== true){
                return $handleApi;
            }


            return $this->returnMsgWithRedirection(
                $request,
                "/login",
                $this->getApiResponseMessage($apiData)
            );


        }


        return $this->returnView($request,getThemeDir().".subviews.authentication.register_as_user");

    }

    public function accountVerification(Request $request){

        $this->data["meta_title"]    = showContent("site_meta.account_verification_meta_title");
        $this->data["meta_desc"]     = showContent("site_meta.account_verification_meta_desc");
        $this->data["meta_keywords"] = showContent("site_meta.account_verification_meta_keywords");

        $this->data["email_value"] = $request->get("email");

        if($request->method()=="POST"){

            $submitType = $request->get("submit_type");
            if($submitType == "resend"){
                return $this->resendVerificationCode($request);
            }

            if (checkRecaptcha($request) !== true) {
                return [
                    "error"          => showContent("support.you_must_verify_that_you_are_not_robot"),
                    "reload_captcha" => true,
                ];
            }

            $validator = $this->service->accountVerificationValidation($request);
            $validator = $this->returnValidatorMsgs($validator);
            if ($validator !== true){
                return $validator;
            }

            $apiData = $this->service->accountVerification($request)->content();

            $handleApi = $this->handleApiResponse($request, $apiData);
            if($handleApi !== true){
                return $handleApi;
            }

            return $this->returnMsgWithRedirection(
                $request,
                "/login",
                $this->getApiResponseMessage($apiData)
            );

        }


        return $this->returnView($request,getThemeDir().".subviews.authentication.account_verification");

    }

    public function resendVerificationCode(Request $request)
    {

        if ($request->method() != "POST") return;

        $validator = $this->service->reSendVerificationCodeValidation($request);
        $validator = $this->returnValidatorMsgs($validator);
        if ($validator !== true) {
            return $validator;
        }

        $apiData = $this->service->reSendVerificationCode($request)->content();

        $handleApi = $this->handleApiResponse($request, $apiData);
        if ($handleApi !== true) {
            return $handleApi;
        }

        return [
            "msg" => $this->getApiResponseMessage($apiData)
        ];

    }


    public function registerAsAgent(Request $request){

        $this->data["meta_title"]    = showContent("site_meta.agent_registration_meta_title");
        $this->data["meta_desc"]     = showContent("site_meta.agent_registration_meta_desc");
        $this->data["meta_keywords"] = showContent("site_meta.agent_registration_meta_keywords");

        if($request->method()=="POST"){

            if($request->get("password") != $request->get("password_confirmation")){
                return [
                    "error" => showContent("authentication.your_password_is_mismatched")
                ];
            }

            if (checkRecaptcha($request) !== true) {
                return [
                    "error"          => showContent("support.you_must_verify_that_you_are_not_robot"),
                    "reload_captcha" => true,
                ];
            }

            $validator = $this->service->registerAsAgentValidation($request);
            $validator = $this->returnValidatorMsgs($validator);
            if ($validator !== true){
                return $validator;
            }

            $request->headers->set('accept-language', $this->primary_lang_title);

            $apiData = $this->service->registerAsAgent($request)->content();

            $handleApi = $this->handleApiResponse($request, $apiData);
            if($handleApi !== true){
                return $handleApi;
            }

            return $this->returnMsgWithRedirection(
                $request,
                "/",
                $this->getApiResponseMessage($apiData)
            );


        }


        return $this->returnView($request,getThemeDir().".subviews.authentication.register_as_agent");

    }


    public function forgetPasswordRequest(Request $request)
    {

        $this->data["meta_title"]    = showContent("site_meta.forget_password_meta_title");
        $this->data["meta_desc"]     = showContent("site_meta.forget_password_meta_desc");
        $this->data["meta_keywords"] = showContent("site_meta.forget_password_meta_keywords");

        if($request->method()=="POST"){

            if (checkRecaptcha($request) !== true) {
                return [
                    "error"          => showContent("support.you_must_verify_that_you_are_not_robot"),
                    "reload_captcha" => true,
                ];
            }

            $validator = $this->service->forgetPasswordRequestValidation($request);
            $validator = $this->returnValidatorMsgs($validator);
            if ($validator !== true){
                return $validator;
            }

            $apiData = $this->service->forgetPasswordRequest($request)->content();


            $handleApi = $this->handleApiResponse($request, $apiData);
            if($handleApi !== true){
                return $handleApi;
            }


            return $this->returnMsgWithRedirection(
                $request,
                "/reset-password?email={$this->getApiResponseData($apiData)->email}",
                $this->getApiResponseMessage($apiData)
            );


        }

        return $this->returnView($request,getThemeDir().".subviews.authentication.forget_password_request");

    }

    public function resetPassword(Request $request)
    {

        $this->data["email_value"] = $request->get("email");

        if($request->method()=="POST"){

            $validator = $this->service->resetPasswordValidation($request);
            $validator = $this->returnValidatorMsgs($validator);
            if ($validator !== true){
                return $validator;
            }

            $apiData = $this->service->resetPassword($request)->content();

            $handleApi = $this->handleApiResponse($request, $apiData);
            if($handleApi !== true){
                return $handleApi;
            }

            return $this->returnMsgWithRedirection(
                $request,
                "/login",
                $this->getApiResponseMessage($apiData)
            );


        }

        return $this->returnView($request,getThemeDir().".subviews.authentication.reset_password");

    }


}
