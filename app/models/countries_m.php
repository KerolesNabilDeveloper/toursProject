<?php

namespace App\models;

use App\form_builder\CountriesBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class countries_m extends Model
{
    use SoftDeletes;

    protected $table = "countries";

    protected $primaryKey = "country_id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'country_code', 'country_mobile_code',
        'country_mobile_start_with', 'country_mobile_length', 'country_name'
    ];


    private static function getData($attrs = [])
    {

        $raw_sql = " countries.* ";
        $data    = self::select(\DB::raw($raw_sql));
        $data    = ModelUtilities::getTranslateData($data, "countries", new CountriesBuilder());

        return ModelUtilities::general_attrs($data, $attrs);

    }

    public static function getAll()
    {
        return self::getData();
    }

    public static function getAllWithPagination($paginate)
    {
        return self::getData([
            "paginate" => $paginate,
            "order_by" => ["country_id", "asc"]
        ]);
    }


}
