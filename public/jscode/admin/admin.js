var callAtLoadSavePage;

var callAtLoadCategories;

$(function(){


    // get parent of categories depends of lang

    $("body").on("change",'#lang_cat_id_id',function(){

        var selected_cat_parent_id = $(".selected_cat_parent_id").val();

        $(
            "label",
            $("#lang_cat_id_id").parents(".form-group")
        ).append(ajax_loader_img_func("10px"));

        var object = {
            "_token": _token,
            "lang_id" : $(this).val()
        };
        $.ajax({
            url: base_url2 + "/" + "admin/categories/get-cats-parent-of-lang" ,
            type: 'POST',
            data: object,
            success: function (data) {

                $(
                    "label img",
                    $("#lang_cat_id_id").parents(".form-group")
                ).remove();

                $(".cat_parent_id option").remove();

                $(".cat_parent_id").append(

                    `<option value="0" >parent</option>`
                );

                var parent_selected = $(".parent_selected").val();
                    console.log(parent_selected);
                $.each(data,function(key,item){
                    $(".cat_parent_id").append(
                        `<option `+(item.cat_id == parent_selected ? "selected": "")+` 
                            value='${item.cat_id}'>${item.cat_name}</option>`
                    );

                });


            }
        });


    });

    callAtLoadCategories  = function(){

        $("#lang_cat_id_id").change();


    };


    addToCallAtLoadArr("callAtLoadCategories");

    //page_test
    /*$("body").on("change",'#page_lang_id_id',function(){

        var selected_cat_id = $(".selected_cat_id").val();

        $(
            "label",
            $("#page_lang_id_id").parents(".form-group")
        ).append(ajax_loader_img_func("10px"));

        var object = {
            "_token": _token,
            "lang_id" : $(this).val()
        };

        $.ajax({
            url: base_url2 + "/" + "admin/categories/get-lang-cats" ,
            type: 'POST',
            data: object,
            success: function (data) {

                console.log(data);

                $(
                    "label img",
                    $("#page_lang_id_id").parents(".form-group")
                ).remove();

                $(".article_parent_cat_class option").remove();
                $(".article_sub_cat_class option").remove();

                var selectedParentId = 0;

                $.each(data.sub_cats.text,function(key,item){

                    if(data.sub_cats.values[key] == selected_cat_id){
                        selectedParentId = data.sub_cats.depend_values[key];
                    }

                    $(".article_sub_cat_class").append(
                        `<option data-targetid="${data.sub_cats.depend_values[key]}" `+(data.sub_cats.values[key] == selected_cat_id ? "selected" : "")+` value='${data.sub_cats.values[key]}'>${item}</option>`
                    );

                });

                $.each(data.parent_cats.text,function(key,item){

                    $(".article_parent_cat_class").append(
                        `<option `+(data.parent_cats.values[key] == selectedParentId ? "selected" : "")+` value='${data.parent_cats.values[key]}'>${item}</option>`
                    );

                });




            }
        });


    });
    callAtLoadSavePage  = function(){
        $("#page_lang_id_id").change();
    };*/
    //categories


    $("body").on("change",'#lang_tour_id',function(){

        var selected_cat_id = $(".selected_cat_id").val();

        console.log('selected_cat_id',selected_cat_id);

        $(
            "label",
            $("#lang_tour_id").parents(".form-group")
        ).append(ajax_loader_img_func("10px"));

        var object = {
            "_token": _token,
            "lang_id" : $(this).val()
        };

        $.ajax({
            url: base_url2 + "/" + "admin/categories/get-lang-cats-to-tour" ,
            type: 'POST',
            data: object,
            success: function (data) {

                console.log(data);

                $(
                    "label img",
                    $("#lang_tour_id").parents(".form-group")
                ).remove();

                $(".tour_parent_cat_class option").remove();
                $(".tour_sub_cat_class option").remove();

                var selectedParentId = 0;

                $.each(data.sub_cats.text,function(key,item){

                    if(data.sub_cats.values[key] == selected_cat_id){
                        selectedParentId = data.sub_cats.depend_values[key];
                    }

                    $(".tour_sub_cat_class").append(
                        `<option data-targetid="${data.sub_cats.depend_values[key]}" `+(data.sub_cats.values[key] == selected_cat_id ? "selected" : "")+` value='${data.sub_cats.values[key]}'>${item}</option>`
                    );

                });

                $.each(data.parent_cats.text,function(key,item){

                    $(".tour_parent_cat_class").append(
                        `<option `+(data.parent_cats.values[key] == selectedParentId ? "selected" : "")+` value='${data.parent_cats.values[key]}'>${item}</option>`
                    );

                });

            }
        });


    });
    callAtLoadSavePage  = function(){

        $("#lang_tour_id").change();
    };


    addToCallAtLoadArr("callAtLoadSavePage");



    if($(".go_to_site_content_keyword").length){

        const urlParams = new URLSearchParams(window.location.search);
        const myParam = urlParams.get('go_to_keyword');

        var id = "#"+myParam+"_id";
        if($(id).length == 0){
            id = "#"+myParam+"id";
        }

        if($(id).length > 0){
            $(id).parents(".form-group").css("background","#EEE");

            $('html, body').animate({
                scrollTop: $(id).offset().top - 40
            }, 500);
        }

    }


});
