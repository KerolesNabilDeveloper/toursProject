<?php

namespace App\models\push_tokens;

use App\models\ModelUtilities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class push_tokens_m extends Model
{

    protected $table      = "push_tokens";
    protected $primaryKey = "id";
    protected $dates      = ["deleted_at"];
    protected $fillable   = [
        'user_id', 'push_token', 'UDID', 'ip_address', 'country', 'device_type',
        'device_name', 'os_version', 'app_version', 'last_login_date', 'send_push'
    ];

    static function get_tokens($attrs = [])
    {

        $results = push_tokens_m::select(DB::raw("
            push_tokens.*,
            users.full_name

        "))
            ->leftJoin("users", function ($join) {
                $join->on("users.user_id", "=", "push_tokens.user_id")
                    ->whereNull("users.deleted_at");
            });

        return ModelUtilities::general_attrs($results, $attrs);

    }

    static function getTokensStatistics($attrs)
    {

        $count = push_tokens_m::where("device_type", $attrs["type"]);

        if (isset($attrs["start_date"]) && isset($attrs["end_date"])) {
            $count = $count->whereBetween('created_at', [$attrs['start_date'], $attrs['end_date']]);
//                ->whereRaw(\DB::raw(" created_at >= " . $attrs["start_date"] . " AND created_at <= " . $attrs["end_date"] ));
        }


        return $count->count();
    }


    static function getUsersIdsTokens(array $userIds): array
    {

        $getUsersTokens = push_tokens_m::
        whereIn("user_id", $userIds)->
        where([
            "send_push" => 1,
        ])->
        where("push_token", "<>", "")->
        orderBy("last_login_date", "desc")->
        get()->all();

        return $getUsersTokens;
    }

    static function getUsersTypeTokensCount(string $userType = "all", string $deviceType = "all"): int
    {

        $getUsersTokensCount = push_tokens_m::
        select(DB::raw(" count(*) as 'tokens_count' "))
            ->leftJoin("users", function ($join) {
                $join->on("users.user_id", "=", "push_tokens.user_id")
                    ->whereNull("users.deleted_at");
            })->
            where([
                "push_tokens.send_push" => 1,
            ])->
            where("push_tokens.push_token", "<>", "");

        if ($userType != "all") {
            $getUsersTokensCount = $getUsersTokensCount->where("users.user_type", "=", $userType);
        }

        if ($deviceType != "all") {
            $getUsersTokensCount = $getUsersTokensCount->where("push_tokens.device_type", "=", $deviceType);
        }

        $getUsersTokensCount = $getUsersTokensCount->get()->first();

        return $getUsersTokensCount->tokens_count;
    }

    public static function savePushToken(array $data): ?object
    {

        if (!isset($data["device-push-token"])) {
            return null;
        }

        $user_id           = (isset($data["user_id"]) ? $data["user_id"] : 0);
        $token             = $data["device-push-token"][0];
        $device_type       = strtolower($data["device-type"][0]);
        $app_version       = $data["app-version"][0];
        $device_name       = $data["device-name"][0];
        $device_os_version = $data["device-os-version"][0];
        $device_udid       = $data["device-udid"][0];
        $last_login_date   = (isset($data["last_login_date"]) ? $data["last_login_date"] : null);
        $ip_address        = (isset($data["ip_address"]) ? $data["ip_address"] : "");

        $attributes               = [];
        $attributes['push_token'] = $token;

        $values                = [];
        $values['user_id']     = $user_id;
        $values['push_token']  = $token;
        $values['device_type'] = strtolower($device_type);
        $values['app_version'] = $app_version;
        $values['device_name'] = $device_name;
        $values['os_version']  = $device_os_version;
        $values['UDID']        = $device_udid;

        if ($last_login_date != null) {
            $values['last_login_date'] = $last_login_date;
        }

        if (!empty($ip_address)) {
            $values['ip_address'] = $ip_address;
        }

        $getUserToken = push_tokens_m::where($attributes)->first();

        if (is_object($getUserToken)) {
            $getUserToken->update($values);
            return $getUserToken;
        }
        else if (!empty($token)) {
            return push_tokens_m::create($values);
        }

        return null;
    }

    public static function unsetPushToken(int $user_id): bool
    {

        $getUserToken = push_tokens_m::where([
            "user_id" => $user_id
        ])->first();


        if (is_object($getUserToken)) {

            $getUserToken->update([
                "user_id" => 0
            ]);

        }

        return false;
    }

    public static function updatePushNotificationStatus(string $udid, array $data): bool
    {
        return push_tokens_m::where("UDID", $udid)->update([
            "send_push" => $data['send_push']
        ]);
    }

    public static function getUserByUdid(string $udid): ?object
    {
        return push_tokens_m::where("UDID", $udid)->first();
    }

    public static function getUsersTokens(array $userIds): Collection
    {

        return push_tokens_m::
        select(DB::raw("
                push_tokens.*,
                push_tokens.push_token as 'token'
            "))->
        whereIn("user_id", $userIds)->
        where("send_push", "1")->
        get();

    }

    public static function deleteRowByToken($token){

        self::where("push_token",$token)->delete();

    }

}
