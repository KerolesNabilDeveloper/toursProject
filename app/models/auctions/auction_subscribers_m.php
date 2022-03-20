<?php

namespace App\models\auctions;

use App\models\ModelUtilities;

class auction_subscribers_m extends \Eloquent
{

    protected $table = "auction_subscribers";

    protected $primaryKey = "id";

    protected $fillable = [
        "auction_id", "user_id", "created_at"
    ];

    public $timestamps = false;

    private static function getData($attrs)
    {

        $results = self::select(\DB::raw("

            auction_subscribers.*,
            user_obj.full_name as 'user_name'

        "))
            ->leftJoin("users as user_obj","user_obj.user_id","=","auction_subscribers.user_id");

        return ModelUtilities::general_attrs($results, $attrs);

    }

    public static function getAuctionSubscribers(int $auctionId)
    {

        $cond   = [];
        $cond[] = "auction_subscribers.auction_id = $auctionId";

        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "auction_subscribers.id",
            'order_by_type' => "desc",
        ])->all();

    }

    public static function userIsSubscribedOnAuction(int $user_id, int $auctionId) :bool
    {

        $cond   = [];
        $cond[] = "auction_subscribers.auction_id = $auctionId";
        $cond[] = "auction_subscribers.user_id = $user_id";

        $getItem = self::getData([
            'free_conds'    => $cond,
            'return_obj'    => "yes",
        ]);

        if (is_object($getItem))
        {
            return true;
        }

        return false;
    }

    public static function subscribeUserToAuction(int $userId, int $auctionId)
    {

        self::create([
            "user_id"       => $userId,
            "auction_id"    => $auctionId,
            "created_at"    => date("Y-m-d H:i:s"),
        ]);

    }

}
