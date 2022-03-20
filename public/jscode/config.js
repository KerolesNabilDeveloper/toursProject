var base_url2;
var base_url;
var _token;
var ajax_loader_img_func;
var lang_url_class;
var check_valid;
var general_check_valid;
var show_flash_message;
var isJson;
var addToCallAtLoadArr;
var loadSelect2AtFront;
var loadSelectBasicAtFront;
var refreshGoogleReCaptcha;
var resetGoogleReCaptcha;
var makeInputsReadOnly;
var copyToClipboard;
var fireCurrentFlashMessage;
var clickToPrint;
var getImageWidthAndHeight;
var socket;

$(function () {

    /**
     * Start initialize global variables
     */

    if (typeof io !== 'undefined') {
        socket = io.connect($(".socket_link").val());
    }

    base_url2            = $(".url_class").val();
    base_url             = base_url2 + "/public/";
    _token               = $(".csrf_input_class").val();
    lang_url_class       = $(".lang_url_class").val();
    ajax_loader_img_func = function (img_width) {
        return "<img src='" + base_url + "images/ajax-loader.gif' class='ajax_loader_class' style='width:" + img_width + ";height:" + img_width + ";'>";
    };

    if (lang_url_class !== '/' && lang_url_class.charAt(0) !== '/') {
        lang_url_class = '/' + lang_url_class;
    }

    /**
     * End initialize global variables
     */

    check_valid = function (parent_element) {

        var valid = true;

        $.each($(".check_valid", parent_element), function () {
            if (!$(this)[0].reportValidity()) {
                valid = false;
                return false;
            }
        });

        return valid;
    };

    general_check_valid = function (parent_element) {

        var valid = true;

        $.each($("input,textarea,select", parent_element), function () {
            if (!$(this)[0].reportValidity()) {
                valid = false;
                return false;
            }
        });

        return valid;
    };

    $("body").on("click", ".hide_alert_fixed", function () {

        var parent_div = $(this).parents(".alert-fixed");

        parent_div.removeClass("alert-fixed-show");
        parent_div.removeClass("alert-success");
        parent_div.removeClass("alert-danger");
        parent_div.removeClass("alert-info");
        parent_div.removeClass("alert-warning");

        return false;
    });

    show_flash_message = function (type, get_flash_message) {
        if (get_flash_message.length == 0) return false;

        var icon = 'info';

        if (type == "error") {
            icon = "error";
        }

        Swal.fire({
            icon: icon,
            html: get_flash_message
        })

    }

    var populateFlashMessage = function () {

        if ($('.get_flash_message').length == 0) {
            return false;
        }

        var get_flash_message = $('.get_flash_message').val();

        if (get_flash_message.length == 0) {
            return false;
        }

        var str  = $('.get_flash_message').val();
        var type = 'info';

        if ($(str).html().length == 0) {
            return false;
        }

        var pure_msg = '<p style="">' + $(str).html() + '</p>';
        if ($(str).html() == undefined) {
            pure_msg = '<p style="">' + str + '</p>';
        }

        if (str.indexOf('alert-danger') > -1) {
            type = 'error'
        }
        else if (str.indexOf('alert-warning') > -1) {
            type = 'error'
        }
        else if (str.indexOf('alert-info') > -1) {
            type = 'info'
        }

        show_flash_message(type, pure_msg);


    }
    populateFlashMessage();

    isJson = function (str) {

        if (typeof (str) == "object") {
            return true;
        }

        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    };

    loadSelect2AtFront = function () {

        if ($(".select_2_front").length == 0) return false;

        setTimeout(function () {
            $(".select_2_front").select2();
        }, 500);


    };
    addToCallAtLoadArr("loadSelect2AtFront");

    loadSelectBasicAtFront = function () {

        if ($(".select_basic_select").length == 0) return false;

        $(".select_basic_select").selectpicker({});

    };
    addToCallAtLoadArr("loadSelectBasicAtFront");


    refreshGoogleReCaptcha = function () {

        if ($(".g-recaptcha").length == 0 || typeof grecaptcha == "undefined") return false;

        setTimeout(function () {
            $(".g-recaptcha").each(function () {
                try {
                    grecaptcha.render($(this)[0], {
                        'sitekey': '6LeCmbUUAAAAAIfFzP536NLvgh9gQwLVwD6sI0HA'
                    });
                } catch (error) {/*possible duplicated instances*/
                }

            });
        }, 1000);

    };

    addToCallAtLoadArr("refreshGoogleReCaptcha");

    resetGoogleReCaptcha = function () {

        if ($(".g-recaptcha").length == 0 || typeof grecaptcha == "undefined") return false;

        grecaptcha.reset();

    };

    makeInputsReadOnly = function () {

        if ($(".make_inputs_read_only").length == 0) {
            return false;
        }

        $("input,textarea,select", $(".make_inputs_read_only")).attr("readonly", "readonly");
        $(".remove_img_from_arr", $(".make_inputs_read_only")).remove();

        $('input[type=file]', $(".make_inputs_read_only")).remove();

        $("select", $(".make_inputs_read_only")).each(function () {

            var selectedValue = $(this).data("selected");
            if (selectedValue === undefined) {
                //continue
                return;
            }

            var parentElement = $(this).parents(".form-group");

            parentElement.append("<input type='text' name='" + $(this).attr("name") + "' class='form-control' value='" + selectedValue + "' readonly>")

            $(".select2", parentElement).remove();
            $("select", parentElement).remove();

        });

    };

    addToCallAtLoadArr("makeInputsReadOnly");

    $('body').on('click', '.make_inputs_read_only .preview_post_img_div', function () {

        window.open($(this).find('img').attr("src"), '_blank');

    });

    getImageWidthAndHeight = function (link) {

        if ($("#get_image_width_and_height").length == 0) {
            $("body").append("<img id='get_image_width_and_height' />");
        }

        if ($("#get_image_width_and_height").attr("src") != "") {
            $("#get_image_width_and_height").attr("src", "");
        }


        var img = document.getElementById('get_image_width_and_height');

        $("#get_image_width_and_height").show();
        $("#get_image_width_and_height").attr("src", link);

        var width  = img.clientWidth;
        var height = img.clientHeight;

        show_flash_message("info", "" +
            "<img src='" + link + "' width='250'> <br> <br> <br>" +
            "Width = " + width + " px, Height = " + height + " px"
        );

        $("#get_image_width_and_height").hide();

    }

    copyToClipboard = function (text) {

        if ($(".copy_to_clipboard").length == 0) {
            $("body").append("<textarea class='copy_to_clipboard'></textarea>");
        }

        $(".copy_to_clipboard").show();
        $(".copy_to_clipboard").html(text);

        $(".copy_to_clipboard").select();

        document.execCommand("copy");
        $(".copy_to_clipboard").hide();

    }

    fireCurrentFlashMessage = function () {

        var flashMessage = localStorage.getItem('flashMessage');
        if (flashMessage == null)
            return false;

        show_flash_message("info", flashMessage);

        localStorage.removeItem('flashMessage');

    };
    addToCallAtLoadArr("fireCurrentFlashMessage");

    clickToPrint = function () {

        // $("iframe").css("display", "none"); // removed because we need to display map on print
        print();

    };


    $("body").on("click", ".showModalContent", function () {

        var this_element = $(this);

        var title   = this_element.attr('data-title');
        var content = this_element.attr('data-content');

        Swal.fire({
            html: "<b>"+title+"</b><br><br>"+content,
            confirmButtonText: $(".sweet_alert_confirmation_yes").val(),
            icon: "info",
        }).then((result) => {
            if (result.isConfirmed) {


            }
        });

        return false;

    });

    var getFlashMessageFromGetParam = function (){

        var url_string       = window.location.href
        var url              = new URL(url_string);
        var flashMessageType = url.searchParams.get("show_flash_type");
        var flashMessage     = url.searchParams.get("show_flash_msg");

        if(flashMessageType == null){
            flashMessageType = "info";
        }

        if(flashMessage==undefined || flashMessage.length == 0)return;

        show_flash_message(flashMessageType,flashMessage);

    };
    getFlashMessageFromGetParam();


    $("body").on("keyup", ".search_for_currency_input", function () {

        var searchKeyword = $(this).val();

        if (searchKeyword.length == 0) {
            $(".hide_or_show_currency").show();
            return true;
        }

        $(".hide_or_show_currency").each(function () {

            $(this).hide();

            if ($(this).data("text").toLowerCase().includes(searchKeyword.toLowerCase())) {
                $(this).show();
            }

        });


    });

});
