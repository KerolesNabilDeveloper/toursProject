<?php

namespace App\models;

use App\form_builder\AuctionsBuilder;
use App\form_builder\CitiesBuilder;
use App\form_builder\CountriesBuilder;
use App\form_builder\DealsBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class orders_m extends Model
{
    use SoftDeletes;

    protected $table = "orders";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'order_type', 'order_type_id', 'user_id', 'order_status',
        'item_quantity', 'item_unit_price', 'total_items_price',
        'order_shipping_amount', 'order_taxes_amount', 'order_total_amount',
        'payment_method_id', 'order_is_paid', 'online_payment_transaction_id',
        'order_shipping_address', 'order_shipping_city_id', 'order_system_delivery_notes',
        'canceled_by_user_type', 'canceled_by_user_id', 'canceled_at', 'cancellation_reason',
        'order_is_refunded', 'order_notes'
    ];

    private static function getData($attrs = [])
    {

        $results = self::select(\DB::raw("
            orders.*,
            users.full_name,
            users.phone,
            cities.city_name,
            countries.country_id,
            countries.country_name,
            auctions.auction_title,
            auctions.auction_tax_number,
            deals.deal_title,
            deals.deal_tax_number,
            Ifnull(deals.seller_name,auctions.seller_name) as 'seller_name'

        "))
            ->join("users","users.user_id","=","orders.user_id")
            ->leftJoin("auctions","auctions.auction_id","=","orders.order_type_id")
            ->leftJoin("deals","deals.deal_id","=","orders.order_type_id")
            ->leftJoin("cities","cities.city_id","=","orders.order_shipping_city_id")
            ->leftJoin("countries","countries.country_id","=","cities.country_id");

        $results = ModelUtilities::getTranslateData($results, "auctions", new AuctionsBuilder());
        $results = ModelUtilities::getTranslateData($results, "deals", new DealsBuilder());
        $results = ModelUtilities::getTranslateData($results, "cities", new CitiesBuilder());
        $results = ModelUtilities::getTranslateData($results, "countries", new CountriesBuilder());

        return ModelUtilities::general_attrs($results, $attrs);

    }

    public static function addNewOrder(array $data)
    {

        $data = cleanParamsForModel($data);

        self::create($data);

    }

    public static function updateOrder(int $id, array $data)
    {

        $data = cleanParamsForModel($data);

        self::find($id)->update($data);

    }


    public static function getUserAuctionsOrders(int $user_id, int $limit)
    {

        $cond   = [];
        $cond[] = "orders.order_type = 'auction'";
        $cond[] = "orders.user_id = $user_id";

        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "orders.id",
            'order_by_type' => "desc",
            'paginate'      => $limit
        ])->all();

    }

    public static function getUserAuctionsOrder(int $user_id, int $order_id)
    {

        $cond   = [];
        $cond[] = "orders.order_type = 'auction'";
        $cond[] = "orders.user_id = $user_id";
        $cond[] = "orders.id = $order_id";

        return self::getData([
            'free_conds'  => $cond,
            'return_obj'  => "yes",
        ]);

    }
    public static function getUserOrder(int $user_id, int $order_id)
    {

        $cond   = [];
        $cond[] = "orders.user_id = $user_id";
        $cond[] = "orders.id = $order_id";

        return self::getData([
            'free_conds'  => $cond,
            'return_obj'  => "yes",
        ]);

    }

    public static function addNewOrderDeal(array $data)
    {

        $data = cleanParamsForModel($data);

        return self::create($data);

    }



    public static function getUserDealsOrder(int $user_id, int $order_id)
    {

        $cond   = [];
        $cond[] = "orders.order_type = 'deal'";
        $cond[] = "orders.user_id = $user_id";
        $cond[] = "orders.id = $order_id";

        return self::getData([
            'free_conds'  => $cond,
            'return_obj'  => "yes",
        ]);

    }


    public static function getUserDealssOrders(int $user_id, int $limit)
    {

        $cond   = [];
        $cond[] = "orders.order_type = 'deal'";
        $cond[] = "orders.user_id = $user_id";

        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "orders.id",
            'order_by_type' => "desc",
            'paginate'      => $limit
        ])->all();

    }
}
