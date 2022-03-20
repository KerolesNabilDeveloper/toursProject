<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class booking_m extends Model
{
    use SoftDeletes;

    protected $table = "booking";

    protected $primaryKey = "booking_id";

    protected $dates = ["deleted_at"];

    protected $fillable = [
        'booking_tour_id','booking_name',
        'booking_email','booking_phone',
        'booking_departing','booking_returning',
        'booking_type'
    ];

    //show all booking
    public static function getAllBooking($langIds)
    {
        $langIds=Vsi($langIds);
        $langIds=implode(",",$langIds);


        $rows=\DB::select("
        select 
        booking.*, 
        tours.tour_title
        from booking
        inner join tours on booking.booking_tour_id=tours.id
        where tours.lang_tour in ({$langIds}) and 
        tours.deleted_at is null 
        
        ");

        return collect($rows);

    }



}
