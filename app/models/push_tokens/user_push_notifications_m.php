<?php

namespace App\models\push_tokens;

use Illuminate\Database\Eloquent\Model;

class user_push_notifications_m extends Model
{

    protected $table        = "user_push_notifications";

    protected $primaryKey   = "id";

    protected $fillable =
    [
        'user_id','title','body','extraPayload', 'is_seen', 'device_type'
    ];

}
