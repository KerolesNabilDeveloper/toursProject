<?php

namespace App\Jobs;

use App\Adapters\IUserAdapter;
use App\Http\Controllers\traits\notificationsTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Collection;

class SendNotificationToAdmins implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, notificationsTrait;

    public $notification_type;
    public $title;
    public $body;
    public $emailBody;
    public $url;

    public function __construct($attrs)
    {

        /*
        $attrs = [
            "notification_type" => "",
            "title"             => "",
            "body"              => "",
            "email_body"        => "",
            "url"               => "",
        ];
        */

        $this->notification_type = $attrs["notification_type"] ?? "send_to_all_anyway";
        $this->title             = $attrs["title"];
        $this->body              = $attrs["body"] ?? $attrs["title"];
        $this->emailBody         = $attrs["email_body"] ?? $this->body;
        $this->url               = $attrs["url"] ?? "/";

        if (strpos($this->emailBody, "<a") === false) {
            $this->emailBody.="<br><a href='".url($this->url)."'>Click Here</a>";
        }

    }

    private function getAllAdminWhoShouldReceiveTheNotification(Collection $get_admins)
    {

        if ($this->notification_type == "send_to_all_anyway") {
            return $get_admins;
        }

        return $get_admins->filter(function ($admin) {
            return (
                strpos($admin->notification_settings, "all") !== false ||
                strpos($admin->notification_settings, $this->notification_type) !== false
            );
        });

    }

    private function sendEmail($emails)
    {

        if (!isset_and_array($emails))
        {
            return;
        }

        //special case at localhost for mailtrap
        if (env('MAIL_HOST') == "smtp.mailtrap.io") {

            foreach ($emails as $email) {

                dispatch(
                    (new sendEmail([
                        "email"     => $email,
                        "subject"   => $this->title . " - " . date("Y-m-d H:i"),
                        "pure_body" => $this->emailBody
                    ]))->onQueue("not_important_queue")
                );

            }

            return;
        }

        (new sendEmail([
            "email"     => $emails,
            "subject"   => $this->title . " - " . date("Y-m-d H:i"),
            "pure_body" => $this->emailBody
        ]))->handle();

    }

    private function sendPushNotification($get_admins)
    {

        (new sendPush([
            "userIds" => $get_admins->pluck("user_id")->all(),
            "title"   => $this->title,
            "body"    => $this->body,
            "url"     => $this->url,
        ]))->handle();

    }

    private function saveNotifications($get_admins)
    {

        $this->sendNotificationToUsers(
            $get_admins->pluck("user_id")->all(),
            $this->title,
            $this->body
        );

    }


    public function handle(
        IUserAdapter $userAdapter
    )
    {

        $get_admins = $userAdapter->getUsersBasedOnType(["admin", "dev"]);
        $get_admins = $this->getAllAdminWhoShouldReceiveTheNotification($get_admins);

        if($get_admins->count() == 0){
            //send to developers email let them know that this email is not received by anyone
            $this->emailBody =
                "<p>this email is sent to your because there is no one to receive from admins</p>" .
                "<br>" . $this->emailBody;
            $this->sendEmail(config('system_emails.developers'));
            return;
        }

        $this->sendEmail($get_admins->pluck("email")->all());
        $this->sendPushNotification($get_admins);
        $this->saveNotifications($get_admins);

    }

}
