<?php

namespace App\models\chat;

use App\models\HasNoTimeStamp;
use Illuminate\Database\Eloquent\Model;

class chat_members_m extends Model
{

    use HasNoTimeStamp;

    protected $table      = "chat_members";
    protected $primaryKey = "cm_id";

    protected $fillable = [
        'chat_id', 'member_id',
    ];

    public static function insertMembers(int $chatId, array $memberIds)
    {

        $insArr    = [];
        $memberIds = array_map("intval", $memberIds);

        foreach ($memberIds as $memberId) {
            $insArr[] = [
                'chat_id'   => $chatId,
                'member_id' => $memberId
            ];
        }

        self::insert($insArr);

    }

    public static function getChatMembersIds(int $chatId)
    {

        return self::where("chat_id", $chatId)->get()->pluck("member_id")->all();

    }

    public static function isMemberOfChat($userId, $chatId)
    {

        $chat_member = self::
        where("chat_id", $chatId)->
        where("member_id", $userId)->get()->first();

        if (is_object($chat_member)) {
            return true;
        }

        return false;

    }


}
