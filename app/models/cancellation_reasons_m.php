<?php

namespace App\models;

use App\form_builder\CancellationReasonsBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cancellation_reasons_m extends Model
{
    use SoftDeletes;

    protected $table = "cancellation_reasons";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'reason_title'
    ];


    private static function getData($attrs = [])
    {

        $raw_sql = " cancellation_reasons.* ";
        $data    = self::select(\DB::raw($raw_sql));
        $data    = ModelUtilities::getTranslateData($data, "cancellation_reasons", new CancellationReasonsBuilder());

        return ModelUtilities::general_attrs($data, $attrs);

    }

    public static function getAll()
    {
        return self::getData();
    }


}
