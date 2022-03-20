<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class subscribes_m extends Model
{
    use SoftDeletes;

    protected $table = "subscribers";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'email'
    ];



}
