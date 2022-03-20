<?php

namespace App\models\vouchers;

use App\form_builder\WalletVouchersBuilder;
use App\models\ModelUtilities;

class wallet_used_vouchers_m extends \Eloquent
{

    protected $table = "wallet_used_vouchers";

    protected $primaryKey = "id";

    protected $fillable = [
        'user_id', 'voucher_id', 'used_at'
    ];

    public $timestamps = false;

    private static function getData($attrs)
    {

        $results = self::select(\DB::raw("
            wallet_used_vouchers.*,
            wallet_vouchers.voucher_code,
            wallet_vouchers.voucher_amount
        "))
            ->join("users as user_obj","user_obj.user_id","=","wallet_used_vouchers.user_id")
            ->join("wallet_vouchers","wallet_vouchers.voucher_id","=","wallet_used_vouchers.voucher_id");

        $results = ModelUtilities::getTranslateData($results, "wallet_vouchers", new WalletVouchersBuilder());

        return ModelUtilities::general_attrs($results, $attrs);

    }


    public static function getPreviousVouchersLogs(int $user_id, int $limit)
    {

        $cond   = [];
        $cond[] = "wallet_used_vouchers.user_id = $user_id";

        return self::getData([
            'free_conds'    => $cond,
            'order_by_col'  => "wallet_used_vouchers.id",
            'order_by_type' => "desc",
            'paginate'      => $limit
        ])->all();

    }

    public static function getUserVoucher(int $userId, int $voucherId)
    {

        $cond   = [];
        $cond[] = "wallet_used_vouchers.user_id = $userId";
        $cond[] = "wallet_used_vouchers.voucher_id = $voucherId";

        return self::getData([
            'free_conds'    => $cond,
            'return_obj'    => "yes",
        ]);

    }

    public static function addNewLog(array $data)
    {

        $data = cleanParamsForModel($data);

        self::create($data);

    }

}
