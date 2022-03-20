<?php

namespace App\models\auctions;

use App\form_builder\AuctionsBuilder;
use App\models\ModelUtilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class auctions_m extends \Eloquent
{

    use SoftDeletes;

    protected $table = "auctions";

    protected $primaryKey = "auction_id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        "user_id", "auction_type", "city_id", "auction_title",
        "auction_img_obj", "auction_slider", "auction_description",
        "auction_require_prequel_insurance_amount", "auction_require_amount_in_wallet",
        "auction_allowed_payment_method_ids", "auction_start_price", "auction_min_sell_price",
        "auction_max_sell_price", "auction_min_bid", "auction_max_bid", "auction_timer_minute",
        "auction_timer_end_at", "auction_tax_number",
        "auction_start_at", "auction_is_active", "auction_is_finished", "auction_finished_at",
        "auction_winner_user_id", "auction_winning_price", "auction_last_bidder_id",
        "auction_last_bidding_amount", "auction_total_subscribers_count", "auction_total_bidders_count"
    ];

    private static function getData($attrs)
    {

        $results = self::select(\DB::raw("
            auctions.* ,
            user_obj.full_name as 'owner_name',
            user_winner_obj.full_name as 'winner_name',
            user_last_bidder_obj.full_name as 'last_bidder_name'
        "))
            ->leftJoin("users as user_obj","user_obj.user_id","=","auctions.user_id")
            ->leftJoin("users as user_winner_obj","user_winner_obj.user_id","=","auctions.auction_winner_user_id")
            ->leftJoin("users as user_last_bidder_obj","user_last_bidder_obj.user_id","=","auctions.auction_last_bidder_id");

        $results = ModelUtilities::getTranslateData($results, "auctions", new AuctionsBuilder());

        return ModelUtilities::general_attrs($results, $attrs);

    }

    public static function getAll()
    {
        return self::getData();
    }

    public static function getAllWithPagination($paginate)
    {
        return self::getData([
            "paginate" => $paginate,
            "order_by" => ["auctions.auction_id", "desc"]
        ]);
    }


    public static function getCurrentAuctions(int $limit)
    {

        $cond   = [];
        $cond[] = "auctions.auction_is_active = 1";
        $cond[] = "auctions.auction_is_finished = 0";
        $cond[] = "auctions.auction_start_at < '".date("Y-m-d H:i:s")."'";

        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "auctions.auction_id",
            'order_by_type' => "desc",
            'paginate'      => $limit
        ])->all();

    }

    public static function getComingAuctions(int $limit)
    {

        $cond   = [];
        $cond[] = "auctions.auction_is_active = 1";
        $cond[] = "auctions.auction_is_finished = 0";
        $cond[] = "auctions.auction_start_at >= '".date("Y-m-d H:i:s")."'";


        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "auctions.auction_start_at",
            'order_by_type' => "asc",
            'paginate'      => $limit
        ])->all();

    }

    public static function getClosedAuctions(int $limit)
    {

        $cond   = [];
        $cond[] = "auctions.auction_is_active = 1";
        $cond[] = "auctions.auction_is_finished = 1";

        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "auctions.auction_finished_at",
            'order_by_type' => "desc",
            'paginate'      => $limit
        ])->all();

    }

    public static function getAuctionDetails(int $id)
    {

        $cond   = [];
        $cond[] = "auctions.auction_is_active = 1";
        $cond[] = "auctions.auction_id = $id";

        return self::getData([
            'free_conds'    => $cond,
            'return_obj'    => "yes"
        ]);

    }

    public static function updateAuction(int $id, array $data)
    {

        $data = cleanParamsForModel($data);

        self::find($id)->update($data);

    }

}
