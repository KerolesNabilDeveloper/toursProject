<?php

namespace App\Http\Controllers;

use App\models\langs_m;
use App\models\notification_m;

class AdminBaseController extends DashboardController
{

    public function __construct()
    {

        parent::__construct();

        $this->getMenu();

        $this->getAllLangs();

    }


    public function getAllLangs()
    {

        if(!empty($this->current_user_data->allowed_langs)){
            $this->data["all_langs"] = langs_m::getDataByLangTitles(json_decode($this->current_user_data->allowed_langs,true));
        }
        else{
            $this->data["all_langs"] = parent::getAllLangsForFront();
        }


    }

    public function getNotificationsHeader()
    {
        $free_cond = " (notifications.to_user_type = 'admin' OR notifications.to_user_id = $this->user_id ) ";

        $get_notifications = notification_m::get_notifications([
            "free_conditions" => $free_cond,
            "order_by_col"    => "notifications.not_id",
            "order_by_type"   => "desc",
            "paginate"        => 5
        ]);

        $get_notifications                  = collect($get_notifications->all())->groupBy('notification_date')->all();
        $this->data['notifications_header'] = $get_notifications;
        $this->data['count_notifications']  = notification_m::where('is_seen', 0)->count();
    }

    private function editContentLinks($menu_links)
    {

        $links = [
            'icon'   => 'icon ion-ios-gear-outline',
            'link'   => '#',
            'childs' => []
        ];

        if (havePermission("admin/site_content", "can_edit_content")) {
            $links["childs"]["Edit Content"] = url("admin/site-content/show_methods");
        }

        if (havePermission("admin/site_content", "copy_from_lang_to_another")) {
            $links["childs"]["Copy & Translate Content"] = url("admin/site-content/copy_from_lang_to_another");
        }

        if (count($links["childs"]) == 0) {
            return $menu_links;
        }

        $menu_links["Site Content"] = $links;

        return $menu_links;
    }

    private function settingsLinks($menu_links)
    {

        $links = [
            'icon'   => 'icon ion-ios-gear-outline',
            'link'   => '#',
            'childs' => []
        ];

        if (false && havePermission("admin/settings", "can_edit_settings")) {
            $links["childs"]["Settings"] = url("admin/settings");
        }

            $links["childs"]["Languages"] = url("admin/langs");


        if (havePermission("admin/admins", "show_action")) {
            $links["childs"]["Admins"] = url("admin/admins");
        }


        $links["childs"]["site-content"] = url("admin/site-content/show_methods");

        $links["childs"]["categories"] = url("admin/categories");
        $links["childs"]["tours"] = url("admin/tours");
        $links["childs"]["pages"] = url("admin/pages");
        $links["childs"]["contact"] = url("admin/contact");
        $links["childs"]["booking"] = url("admin/booking");


        if (count($links["childs"]) == 0) {
            return $menu_links;
        }

        $menu_links["Site settings"] = $links;

        return $menu_links;

    }

    private function auctionsLinks($menu_links)
    {


        $links = [
            'icon'   => 'icon ion-ios-gear-outline',
            'link'   => '#',
            'childs' => []
        ];






        if (count($links["childs"]) == 0) {
            return $menu_links;
        }

        return $menu_links;

    }

    private function dealsLinks($menu_links)
    {

        $links = [
            'icon'   => 'icon ion-ios-gear-outline',
            'link'   => '#',
            'childs' => []
        ];


        if (count($links["childs"]) == 0) {
            return $menu_links;
        }

        return $menu_links;

    }

    private function blogAndPagesLinks($menu_links)
    {

        $links = [
            'icon'   => 'icon ion-ios-book-outline',
            'link'   => '#',
            'childs' => []
        ];



        if (count($links["childs"]) == 0) {
            return $menu_links;
        }

        $menu_links["Blog & Pages"] = $links;

        return $menu_links;

    }

    private function supportLinks($menu_links)
    {

        $links = [
            'icon'   => 'icon ion-ios-chatboxes-outline',
            'link'   => '#',
            'childs' => []
        ];


        if (havePermission("admin/support_messages", "show_action")) {
            $links["childs"]["المحادثات"] = url("admin/chats/all");
        }


        if (count($links["childs"]) == 0) {
            return $menu_links;
        }

        $menu_links["الدعم الفني"] = $links;

        return $menu_links;

    }

    public function getMenu()
    {

        $menu_links = [];

        $menu_links["dashboard"] = [
            'icon' => 'icon ion-ios-home-outline',
            'link' => url("/admin/dashboard")
        ];

        $menu_links = $this->settingsLinks($menu_links);
        $menu_links = $this->auctionsLinks($menu_links);
        $menu_links = $this->dealsLinks($menu_links);
        $menu_links = $this->supportLinks($menu_links);

        if (false) {
            $menu_links = $this->blogAndPagesLinks($menu_links);
            $menu_links = $this->editContentLinks($menu_links);
        }

        $this->data["menu_links"] = $menu_links;

    }

}
