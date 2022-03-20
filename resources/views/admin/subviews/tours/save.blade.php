<?php

    $header_text        = "Add New";
    $id            = "";

    if (is_object($item_data)) {
        $header_text    = front_tf($item_data->tour_name);
        $id        = $item_data->id;
    }

?>

<div class="slim-mainpanel">
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("admin/dashboard")}}">dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url("admin/tours")}}">tours</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$header_text}}</li>
            </ol>
            <h6 class="slim-pagetitle">{{$header_text}}</h6>
        </div><!-- slim-pageheader -->

        <div class="section-wrapper">
            <?php if(havePermission("admin/tours","add_action")): ?>
                <label class="section-title">
                    <a class="btn btn-primary mg-b-6" href="{{url("admin/tours/save")}}"> Add new <i class="fa fa-plus"></i></a>
                </label>
            <?php endif; ?>
            <p class="mg-b-20 mg-sm-b-40"></p>

            <div class="table-wrapper">


                <form id="save_form" class="ajax_form" action="{{url("admin/tours/save/$id")}}" method="POST" enctype="multipart/form-data">
                    <label>select language</label>
                    <select name="lang_tour" id="lang_tour_id" class="form-control lang_tour_id_id col-12 select_primary" >
                        @foreach($all_langs as $lang)
                            <option
                                <?php
                                    if(is_object($item_data) && $item_data->lang_tour==$lang->lang_id)
                                     {
                                        echo "selected";
                                     }
                                 ?>
                                value="{{$lang->lang_id}}">
                                {{$lang->lang_text}}
                            </option>
                        @endforeach
                    </select>
                    <br>

                    <?php
                    echo generate_depended_selects(
                        $field_name_1="select_id",
                        $field_label_1 = "selcet parent cat",
                        $field_text_1 = [],
                        $field_values_1 = [],
                        $field_selected_value_1 = "",
                        $field_required_1 = "",
                        $field_class_1 = "form-control tour_parent_cat_class",

                        $field_name_2 ="tour_cat_id",
                        $field_label_2 = "selcet child cat",
                        $field_text_2 = [],
                        $field_values_2= [],
                        $field_selected_value_2 = "",
                        $field_2_depend_values = [],
                        $field_required_2 = "",
                        $field_class_2 = "form-control tour_sub_cat_class",

                        $field_data_name1 = "",
                        $field_data_values1 = "",
                        $field_data_name2 = "",
                        $field_data_values2 = "",

                        $data_obj = ""
                    );

                    ?>
                    @include("general_form_blocks.main_form")


                    <input type="hidden" class="selected_cat_id" value="{{$item_data->tour_cat_id ?? ""}}">




                    {{csrf_field()}}

                    <div class="form-layout-footer">
                        <input id="submit" type="submit" value="save" class="btn btn-primary bd-0">
                    </div>

                </form>

            </div><!-- table-wrapper -->
        </div><!-- section-wrapper -->

    </div><!-- container -->
</div><!-- slim-mainpanel -->




