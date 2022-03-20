<?php

namespace App\models;

use App\form_builder\CommentReportReasonsBuilder;
use App\form_builder\CountriesBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class comment_report_reasons_m extends Model
{
    use SoftDeletes;

    protected $table = "comment_report_reasons";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'reason_title'
    ];


    private static function getData($attrs = [])
    {

        $raw_sql = " comment_report_reasons.* ";
        $data    = self::select(\DB::raw($raw_sql));
        $data    = ModelUtilities::getTranslateData($data, "comment_report_reasons", new CommentReportReasonsBuilder());

        return ModelUtilities::general_attrs($data, $attrs);

    }

    public static function getAll()
    {
        return self::getData();
    }


}
