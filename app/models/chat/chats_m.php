<?php

namespace App\models\chat;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class chats_m extends Model
{

    use SoftDeletes;

    protected $table      = "chats";
    protected $primaryKey = "chat_id";
    protected $dates      = ["deleted_at"];

    protected $fillable = [
        'chat_enc_id',
        'chat_name', 'chat_type', 'chat_type_id', 'chat_member_ids'
    ];


    public static function getChatObjByChatEncId(string $chatEncId)
    {

        return self::where("chat_enc_id", Vsi($chatEncId))->limit(1)->get()->first();

    }

    public static function getChatObjs(array $chatIds)
    {

        $chatIds = array_map("intval", $chatIds);

        return self::whereIn("chat_id", $chatIds)->get();

    }

    public static function getTargetChat(array $memberIds, string $chatType, int $chatTypeId, string $chatName = "")
    {

        $chatType  = Vsi($chatType);
        $memberIds = array_map("intval", $memberIds);
        sort($memberIds);

        $chatObj = self::where("chat_type", $chatType)->
        where("chat_type_id", $chatTypeId)->
        whereRaw(\DB::raw("chat_member_ids like '" . ",".implode(",", $memberIds)."," . "'"))->
        get()->first();


        if (!is_object($chatObj)) {

            $chatObj = self::create([
                'chat_enc_id'     => md5($chatName . time() . rand(11111, 99999)),
                'chat_name'       => $chatName,
                'chat_type'       => $chatType,
                'chat_type_id'    => $chatTypeId,
                'chat_member_ids' => ",".implode(",", $memberIds).",",
            ]);

            chat_members_m::insertMembers($chatObj->chat_id, $memberIds);

        }

        return $chatObj;

    }

    public static function getUserChats(int $userId, int $page)
    {

        return self::
        whereRaw(\DB::raw("chat_member_ids like '%,$userId,%'"))->
        limit(20)->
        offset(($page - 1) * 20)->
        orderBy("updated_at", "desc")->
        get();

    }


}
