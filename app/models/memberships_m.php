<?php

namespace App\models;

use App\form_builder\MembershipsBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class memberships_m extends Model
{
    use SoftDeletes;

    protected $table = "memberships";

    protected $primaryKey = "membership_id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'membership_title', 'membership_price', 'membership_valid_days', 'membership_permissions',
        'is_active'
    ];


    private static function getData($attrs = [])
    {

        $raw_sql = " memberships.* ";
        $data    = self::select(\DB::raw($raw_sql));
        $data    = ModelUtilities::getTranslateData($data, "memberships", new MembershipsBuilder());

        return ModelUtilities::general_attrs($data, $attrs);

    }

    public static function getAll()
    {
        return self::getData();
    }


    public static function membershipsList()
    {
        $cond   = [];
        $cond[] = "memberships.is_active = 1";

        return self::getData([
            'free_conds'    => $cond
        ])->all();

    }

}
