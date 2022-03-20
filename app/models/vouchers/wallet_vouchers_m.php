<?php

namespace App\models\vouchers;

use App\form_builder\WalletVouchersBuilder;
use App\models\ModelUtilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class wallet_vouchers_m extends \Eloquent
{

    use SoftDeletes;

    protected $table = "wallet_vouchers";

    protected $primaryKey = "voucher_id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'voucher_title', 'voucher_code', 'voucher_usage_limit',
        'voucher_used_count', 'voucher_start_at', 'voucher_end_at',
        'voucher_amount', 'is_active'
    ];

    private static function getData($attrs)
    {

        $results = self::select(\DB::raw("
            wallet_vouchers.*
        "));

        $results = ModelUtilities::getTranslateData($results, "wallet_vouchers", new WalletVouchersBuilder());

        return ModelUtilities::general_attrs($results, $attrs);

    }


    public static function getValidVoucherByCode(string $code)
    {

        $dateNow = date("Y-m-d H:i:s");

        $cond   = [];
        $cond[] = "wallet_vouchers.is_active = 1";
        $cond[] = "wallet_vouchers.voucher_start_at <= '$dateNow'";
        $cond[] = "wallet_vouchers.voucher_end_at >= '$dateNow'";
        $cond[] = "wallet_vouchers.voucher_code = '$code'";

        return self::getData([
            'free_conds'  => $cond,
            'return_obj'  => "yes",
        ]);

    }

    public static function getValidVoucherById(int $id)
    {

        $dateNow = date("Y-m-d H:i:s");

        $cond   = [];
        $cond[] = "wallet_vouchers.voucher_id = $id";
        $cond[] = "wallet_vouchers.is_active = 1";
        $cond[] = "wallet_vouchers.voucher_start_at <= '$dateNow'";
        $cond[] = "wallet_vouchers.voucher_end_at >= '$dateNow'";

        return self::getData([
            'free_conds'  => $cond,
            'return_obj'  => "yes",
        ]);

    }

    public static function updateVoucher(int $id, array $data)
    {

        $data = cleanParamsForModel($data);

        self::find($id)->update($data);

    }

}
