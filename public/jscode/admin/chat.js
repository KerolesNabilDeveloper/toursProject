var scrollToLastMsg;
var sendMessageViaSocket;
var loadChatMsgs;
var prepareMsgToAppend;

$(function () {

    socket.emit("login-to-chat-socket", {
        'user_enc_id': $(".this_user_enc_id").val(),
        'chat_enc_id': $(".this_chat_enc_id").val()
    });

    if ($(".load_admin_chat_js_file").length > 0) {
        return false;
    }

    $("body").append("<input type='hidden' class='load_admin_chat_js_file' >");

    prepareMsgToAppend = function (item, appendMethod) {

        let newElement = $(".first_message_div").first().clone();

        if (item.user.enc_id == $(".this_user_enc_id").val()) {
            newElement.addClass("sent");
        }
        else {
            newElement.removeClass("sent");
        }

        newElement.attr("id", `msg_${item.message_id}`);
        $(".user_img", newElement).attr("src", `${item.user.image}`);
        $(".username", newElement).text(`${item.user.name}`);
        $(".timestamp", newElement).text(`${item.at}`);
        $(".msg_itself", newElement).text(`${item.message}`);

        $(".attachment_class", newElement).attr("href", `${item.attachment_path}`);

        $(".attachment_class", newElement).addClass("hide_div");
        if (item.attachment_path.length > 0) {
            $(".attachment_class", newElement).removeClass("hide_div");
        }

        return newElement;

    };

    socket.on("msg_output", function (data) {

        let item       = data.msgObj;
        $(".append_msgs").append(prepareMsgToAppend(item));
        scrollToLastMsg();

    });


    scrollToLastMsg = function () {
        if ($('.all_chat_msgs').length == 0) {
            return false;
        }
        $('.all_chat_msgs').scrollTop($('.all_chat_msgs')[0].scrollHeight);
    };
    addToCallAtLoadArr("scrollToLastMsg");

    $("body").on("keyup", ".message_text_textarea", function (e) {

        if (e.which === 13 && e.shiftKey == false) {
            $(this).parents(".send_msg_form").submit();
        }

    });

    $("body").on("submit", ".send_msg_form", function () {

        var this_element = $(this);
        var parent_div   = this_element.parents(".chat_parent_div");
        var formElement  = $(".send_msg_form");
        var formData     = new FormData(formElement[0]);

        this_element.append(ajax_loader_img_func("10px"));

        if ($(".chat_msg_file").val() == "") {
            socket.emit("send-message-to-server", {
                'this_user_enc_id': $(".this_user_enc_id").val(),
                'chat_enc_id': $(".this_chat_enc_id").val(),
                'message': $(".message_text_textarea").val(),
                'this_chat_members_enc_ids': $(".this_chat_members_enc_ids").val()
            });

            this_element.children("img").remove();
            $(".message_text_textarea", parent_div).val("");

            return false;
        }

        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        show_progress_bar(Math.round((evt.loaded / evt.total) * 100));
                    }
                }, false);

                xhr.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        show_progress_bar(Math.round((evt.loaded / evt.total) * 100));
                    }
                }, false);
                return xhr;
            },
            url: formElement.attr("action"),
            type: 'POST',
            cache: false,
            processData: false,
            contentType: false,
            data: formData,
            success: function (data) {

                scrollToLastMsg();

                $(".chat_msg_file").val("");
                this_element.children("img").remove();
                $(".message_text_textarea", parent_div).val("");

                if (data.msg !== undefined) {
                    show_flash_message("info", data.msg);
                }

                if (data.error !== undefined) {
                    show_flash_message("error", data.error);
                    $(".ajax_page_loader").hide();
                    return false;
                }


            }
        });

        return false;

    });


    loadChatMsgs = function (chatEncId, lastMessageId, parent_element) {

        $(".load_more_msgs", parent_element).append(ajax_loader_img_func("10px"));
        $(".load_more_msgs", parent_element).attr("disabled","disabled");

        var obj             = {};
        obj.last_message_id = lastMessageId;

        $.ajax({
            url: base_url2 + `/admin/chats/get-more-msgs/${chatEncId}`,
            type: "GET",
            data: obj,
            success: function (data) {
                data = data.result;

                $(".load_more_msgs", parent_element).children("img").remove();
                $(".load_more_msgs", parent_element).removeAttr("disabled");

                if (data.last_shown_msg_id != "") {
                    $(".last_msg_id", parent_element).val(data.last_shown_msg_id);
                }
                else {
                    $(".load_more_msgs", parent_element).hide();
                }

                for(let item of data.messages){
                    $(".append_msgs").prepend(prepareMsgToAppend(item));
                }


            }
        });
    };

    $("body").on("click", ".load_more_msgs", function () {

        var this_element   = $(this);
        var parent_element = this_element.parents(".all_chat_msgs");

        loadChatMsgs(
            this_element.attr("data-chatid"),
            $(".last_msg_id", parent_element).val(),
            parent_element
        );

    });


    $("body").on("click", ".remove_message", function () {

        var confirm_res = confirm("are you sure?");
        if (!confirm_res) {
            return false;
        }

        var this_element = $(this);
        this_element.append(ajax_loader_img_func("10px"));


        var obj    = {};
        obj._token = _token;
        obj.msg_id = this_element.data("msg_id");

        $.ajax({
            url: base_url2 + "/chats/remove_msg",
            type: "POST",
            data: obj,
            success: function (data) {
                this_element.children("img").remove();

                this_element.parents(".parent_chat_li").remove();
            }
        });

        return false;
    });

});
