<?php

namespace App\models\chat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class chat_messages_m extends Model
{
    use SoftDeletes;

    protected $table      = "chat_messages";
    protected $primaryKey = "chat_msg_id";
    protected $dates      = ["deleted_at"];

    protected $fillable = [
        'chat_id', 'user_id', 'message', 'attachment_obj'
    ];

    static function get_messages($additional_where)
    {
        return
            DB::select("
             select
             msg.*,
             msg.created_at as 'msg_date',
             user_obj.user_enc_id,
             user_obj.full_name as 'full_name',
             user_obj.logo_img_obj

             from chat_messages as msg

             INNER JOIN users as user_obj on(msg.user_id = user_obj.user_id)

             where  msg.deleted_at is null $additional_where
         ");
    }

    public static function getInnerChatMessages(int $chatId, $lastShownMessageId)
    {


        $chat_msgs_additional_condition = [" AND msg.chat_id = $chatId"];

        if ($lastShownMessageId != 0) {
            $chat_msgs_additional_condition[] = " AND msg.chat_msg_id<$lastShownMessageId";
        }

        $chat_msgs_additional_condition[] = "
            order by chat_msg_id desc
            limit 20
        ";

        return self::get_messages(implode("", $chat_msgs_additional_condition));

    }

    public static function getChatMessages(array $chat_ids)
    {

        $chat_ids = array_map("intval", $chat_ids);

        return self::get_messages("
            AND chat_id in (" . implode(",", $chat_ids) . ")
            order by chat_msg_id desc
        ");

    }

    public static function getLastChatMessage($chat_ids)
    {

        $chat_ids = array_map("intval", $chat_ids);

        return self::get_messages("
            AND
            msg.chat_id in (" . implode(",", $chat_ids) . ")
            order by chat_msg_id desc
            limit 1
        ");

    }

    static function getLastMsgsOfChats($chat_ids)
    {

        //TODO should be changed because this query is not good for DB performance

        if (!isset_and_array($chat_ids)) {
            return [];
        }

        return DB::select("
            select
            user_obj.full_name,
            user_obj.logo_img_obj,
            chat_messages.*

            from `chat_messages`

            inner join users as user_obj on user_obj.user_id = chat_messages.user_id

            left join `chat_messages` as `cm2`
                on `cm2`.`chat_id` = `chat_messages`.`chat_id` and
                `cm2`.`chat_msg_id` > chat_messages.chat_msg_id and
                `chat_messages`.`deleted_at` is null and
                `cm2`.`deleted_at` is null

            where
            `cm2`.`chat_msg_id` is null
            and `chat_messages`.`chat_id` in (" . implode(",", $chat_ids) . ")
            AND `chat_messages`.deleted_at is null
            order by chat_messages.chat_msg_id desc
        ");


    }

    public static function getMessageObj(int $msg_id)
    {

        return self::get_messages(" AND msg.chat_msg_id=$msg_id");

    }

    static function saveMessage(int $chatId, int $userId, array $data)
    {

        return self::create([
            'chat_id'        => $chatId,
            'user_id'        => $userId,
            'message'        => Vsi($data["message"]),
            "attachment_obj" => $data["attachment_obj"],
        ]);

    }

    static function removeMessage(int $messageId,int $chatId, int $userId){

        self::
        where("user_id",$userId)->
        where("chat_id",$chatId)->
        where("chat_msg_id",$messageId)->
        delete();

    }

}
