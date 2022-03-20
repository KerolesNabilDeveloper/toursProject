<?php

namespace App\models\deals;

use App\models\ModelUtilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class deals_cart_items_m extends \Eloquent
{

    public    $timestamps = false;



    protected $table = "deals_cart_items";

    protected $primaryKey = "id";


    protected $fillable = [
        "deal_id","user_id","item_quantity","created_at","updated_at"
    ];



    private static function getData($attrs)
    {

        $results = self::select(\DB::raw("
            deals_cart_items.* , deal_obj.*"))
            ->leftJoin("deals as deal_obj","deal_obj.deal_id","=","deals_cart_items.deal_id");

        return ModelUtilities::general_attrs($results, $attrs);

    }


    public static function addTocCart(array $data): object
    {
        $attributes = [];
        $attributes['user_id']= $data['user_id'];
        $attributes['deal_id'] = $data['deal_id'];

        return self::updateOrCreate($attributes, $data);

    }

    public static function getUserCart(int $user_id): array
    {
        $cond   = [];
        $cond[] = "deals_cart_items.user_id = $user_id";

        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "",
            'order_by_type' => "",
            'paginate'      => 0
        ])->all();

    }

    public static function deleteItemFromCart(int $user_id,int $item_id)
    {
        return self::where('user_id',$user_id)->where('id',$item_id)->delete();
    }

    public static function deleteItemFromCartAll(int $user_id)
    {
        return self::where('user_id',$user_id)->delete();
    }



    public static function checkCartItem(int $id,int $user_id)
    {

        return self::where('user_id',$user_id)->where('id',$id)->first();

    }


}
