<?php

namespace App\models\deals;

use App\models\ModelUtilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class deal_notifiers_m extends \Eloquent
{

    public    $timestamps = false;



    protected $table = "deal_notifiers";

    protected $primaryKey = "id";


    protected $fillable = [
        "deal_id","user_id","created_at"
    ];



    private static function getData($attrs)
    {

        $results = self::select(\DB::raw("
            deal_notifiers.*"))
            ->Join("deals as deal_obj","deal_obj.deal_id","=","deal_notifiers.deal_id");


        return ModelUtilities::general_attrs($results, $attrs);

    }


    public static function createNotifierDeal(array $data): object
    {

        $attributes = [];
        $attributes['user_id']= $data['user_id'];
        $attributes['deal_id'] = $data['deal_id'];

        return self::updateOrCreate($attributes, $data);

    }



    public static function getUserNotifier(int $user_id): object
    {
        $cond   = [];
        $cond[] = "deal_notifiers.user_id = $user_id";
        $cond[] = "deal_obj.deal_is_active = 1";
        $cond[] = "deal_obj.deal_start_at >= '".date("Y-m-d H:i:s")."'";

        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "",
            'order_by_type' => "",
            'paginate'      => 0,
            'without_get'      => true,
        ])->get();

    }




}
