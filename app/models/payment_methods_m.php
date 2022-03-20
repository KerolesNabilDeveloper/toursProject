<?php

namespace App\models;

use App\form_builder\PaymentMethodsBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class payment_methods_m extends Model
{
    use SoftDeletes;

    protected $table = "payment_methods";

    protected $primaryKey = "payment_method_id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'payment_method_title', 'payment_method_img_obj', 'payment_method_type',
        'payment_method_is_active',
    ];


    private static function getData($attrs = [])
    {

        $raw_sql = " payment_methods.* ";
        $data    = self::select(\DB::raw($raw_sql));
        $data    = ModelUtilities::getTranslateData($data, "payment_methods", new PaymentMethodsBuilder());

        return ModelUtilities::general_attrs($data, $attrs);

    }

    public static function getAll()
    {
        return self::getData();
    }


    public static function paymentList()
    {
        $cond   = [];
        $cond[] = "payment_methods.payment_method_is_active = 1";

        return self::getData([
            'free_conds'    => $cond
        ])->all();

    }


    public static function paymentListId($ids)
    {
        $cond   = [];
        $cond[] = "payment_methods.payment_method_is_active = 1";
        $cond[] = "payment_methods.payment_method_id IN  ($ids)";

        return self::getData([
            'free_conds'    => $cond
        ])->all();

    }


}
