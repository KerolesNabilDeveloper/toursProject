<?php

namespace App;

use App\models\ModelUtilities;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;


    protected $fillable = [
        'user_enc_id', 'api_id', 'provider',
        'logo_img_obj', 'username', 'email',
        'full_name', 'user_type',
        'password', 'password_changed_at',
        'remember_token', 'user_is_blocked', 'is_active', 'allowed_langs',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $primaryKey = 'user_id';

    protected $dates = ["deleted_at"];

    static function get_users($attrs = [])
    {

        return self::getUsers($attrs);

    }

    static function getAdmins($attrs = [])
    {

        if (!isset($attrs["free_conds"])) {
            $attrs["free_conds"] = [];
        }
        $attrs["free_conds"][] = "users.user_type in ('dev','admin')";


        $res = User::select(DB::raw("
            users.*,
            users.created_at as 'user_created_at'
        "));

        return ModelUtilities::general_attrs($res, $attrs);

    }

    static function getUsers($attrs = [])
    {

        $res = User::select(DB::raw("
            users.*,
            users.created_at as 'user_created_at'
        "));

        return ModelUtilities::general_attrs($res, $attrs);
    }

    static function getUsersByIds(array $userIds)
    {

        if(count($userIds) == 0){
            return collect([]);
        }

        $attrs = [
            "free_conds" => [
                "users.user_id in (" . implode(",", $userIds) . ")"
            ]
        ];

        return self::get_users($attrs);

    }

    public static function getTotalUsers($attrs = [])
    {

        $res = User::select(DB::raw("
            count(*) as total_count
        "));

        $res = $res->leftJoin("agency_details", "agency_details.user_id", "=", "users.user_id");

        return ModelUtilities::general_attrs($res, $attrs);

    }

    public static function getUserByEncId(string $userEndId)
    {
        $attrs               = [];
        $attrs['free_conds'] = ['users.user_enc_id="' . Vsi($userEndId) . '"'];
        $attrs['return_obj'] = "yes";

        $user = self::getUsers($attrs);

        if (!is_object($user)) {
            return null;
        }

        return $user;

    }

    public static function getUserByEmailAndType(string $email, string $user_type): ?object
    {
        return self::where("email", $email)->where("user_type", $user_type)->first();
    }

    public static function getSubUsers(int $parentId, string $userType): Collection
    {

        return self::getUsers([
            "cond" => [
                ['users.sub_user_for_agency_id', "=", $parentId],
                ['users.user_type', "=", $userType],
            ]
        ]);

    }

    public static function getAgent(?int $agentId): ?object
    {
        return self::getAgents([
            "cond"       => [
                ['users.user_id', "=", $agentId]
            ],
            "return_obj" => "yes"
        ]);
    }


    public static function getUser(array $data): ?object
    {
        return self::where($data)->first();
    }

    public static function createUser(array $data): object
    {
        return self::create($data);
    }

    public static function updateUser(array $data, int $user_id): bool
    {
        return self::where('user_id', $user_id)->update($data);
    }

    public static function getUserProfile(int $user_id): ?object
    {
        $cond   = [];
        $cond[] = ["users.user_id", "=", $user_id];
        return self::get_users([
            'additional_and_wheres' => $cond,
            'return_obj'            => "yes"
        ]);
    }

    public static function getUsersBasedOnType(array $user_type): Collection
    {

        return self::whereIn("user_type", $user_type)->get();

    }

    public static function getEmailsOfAdmins($langTitle)
    {
        $langTitle=Vsi($langTitle);

        $emails=DB::select("
        
               select 
               email 
               from users
               where allowed_langs like '%{$langTitle}%' and
               user_type in ('admin','dev') and 
               deleted_at is null
        
        ");

        return collect($emails)->pluck('email')->all();


    }


}
