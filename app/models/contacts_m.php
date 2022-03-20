<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contacts_m extends Model
{
    use SoftDeletes;

    protected $table = "contact_us";

    protected $primaryKey = "contact_id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'contact_name','contact_email','contact_lang_id',
        'contact_number','contact_message'
    ];

    public static function getAllContact($langids)
    {
        $langids=Vsi($langids);

        $langids=implode(",",$langids);

        $rows=\DB::select("
            select 
              * 
            from contact_us
            where contact_lang_id in ({$langids}) 
        ");

        return collect($rows);
    }

}
