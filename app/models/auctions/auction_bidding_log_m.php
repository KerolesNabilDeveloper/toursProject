<?php

namespace App\models\auctions;

use App\models\ModelUtilities;

class auction_bidding_log_m extends \Eloquent
{

    protected $table        = "auction_bidding_log";

    protected $primaryKey   = "id";

    protected $fillable     = [
        "auction_id", "user_id", "bidding_amount", "bid_at"
    ];

    public $timestamps = false;

    private static function getData($attrs)
    {

        $results = self::select(\DB::raw("

            auction_bidding_log.*,
            user_obj.full_name as 'user_name'

        "))
            ->leftJoin("users as user_obj","user_obj.user_id","=","auction_bidding_log.user_id");

        return ModelUtilities::general_attrs($results, $attrs);

    }

    public static function getAuctionBidders(int $auctionId)
    {

        $cond   = [];
        $cond[] = "auction_bidding_log.auction_id = $auctionId";

        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "auction_bidding_log.id",
            'order_by_type' => "desc",
            'limit'         => 20,
        ])->all();

    }

    public static function addToLog(array $data)
    {

        $data = cleanParamsForModel($data);

        self::create($data);

    }

}
