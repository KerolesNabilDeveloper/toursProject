<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class blacklist_words_m extends Model
{
    use HasNoTimeStamp;

    protected $table = "blacklist_words";

    protected $primaryKey = "id";

    protected $fillable = [
        'title'
    ];


    private static function getData($attrs = [])
    {

        $raw_sql = " blacklist_words.* ";
        $data    = self::select(\DB::raw($raw_sql));

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
            "order_by" => ["id", "asc"]
        ]);
    }


}
