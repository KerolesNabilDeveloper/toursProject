<?php

namespace App\models\deals;

use App\form_builder\DealsBuilder;
use App\models\ModelUtilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class deals_m extends \Eloquent
{

    use SoftDeletes;

    protected $table = "deals";

    protected $primaryKey = "deal_id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'user_id', 'seller_name',
        'city_id', 'deal_allowed_payment_method_ids',
        'deal_title', 'deal_description',
        'deal_img_obj', 'deal_slider',
        'deal_target_type', 'deal_unit_price',
        'deal_total_quantity', 'deal_bought_quantity',
        'deal_start_at', 'deal_end_at',
        'deal_is_active',
        'deal_max_sell_quantity_for_normal_user', 'deal_max_sell_quantity_for_premium_user',
        'deal_shipping_price', 'auction_require_amount_in_wallet'
    ];

    private static function getData($attrs = [])
    {

        $results = self::select(\DB::raw("deals.*"));
        $results = ModelUtilities::getTranslateData($results, "deals", new DealsBuilder());

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
            "order_by" => ["deals.deal_id", "desc"]
        ]);
    }

    public static function getCurrentDeals(int $limit)
    {

        $cond   = [];
        $cond[] = "deals.deal_is_active = 1";
        $cond[] = "deals.deal_start_at < '".date("Y-m-d H:i:s")."'";
        $cond[] = "deals.deal_end_at > '".date("Y-m-d H:i:s")."'";

        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "deals.deal_id",
            'order_by_type' => "desc",
            'paginate'      => $limit
        ])->all();

    }

    public static function getComingDeals(int $limit)
    {

        $cond   = [];
        $cond[] = "deals.deal_is_active = 1";
        $cond[] = "deals.deal_start_at >= '".date("Y-m-d H:i:s")."'";


        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "deals.deal_id",
            'order_by_type' => "asc",
            'paginate'      => $limit
        ])->all();

    }

    public static function getClosedDeals(int $limit)
    {

        $cond   = [];
        $cond[] = "deals.deal_is_active = 1";
        $cond[] = "deals.deal_end_at IS NOT NULL";

        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "deals.deal_id",
            'order_by_type' => "desc",
            'paginate'      => $limit
        ])->all();

    }

    public static function getDealDetails(int $id)
    {

        $cond   = [];
        $cond[] = "deals.deal_is_active = 1";
        $cond[] = "deals.deal_id = $id";

        return self::getData([
            'free_conds'    => $cond,
            'return_obj'    => "yes"
        ]);

    }



    public static function checkDeal(int $id)
    {

        $cond   = [];
        $cond[] = "deals.deal_is_active = 1";
        $cond[] = "deals.deal_id = $id";

        return self::getData([
            'free_conds'    => $cond,
            'return_obj'    => "yes"
        ]);

    }

}
