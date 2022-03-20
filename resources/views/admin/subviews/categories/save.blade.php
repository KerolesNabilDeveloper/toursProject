<?php

    $header_text        = "categories";
    $cat_id            = "";

    if (is_object($item_data)) {
        $header_text    = front_tf($item_data->cat_name);
        $cat_id        = $item_data->cat_id;
    }

?>

<div class="slim-mainpanel">
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("admin/dashboard")}}">dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url("admin/categories")}}">categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$header_text}}</li>
            </ol>
            <h6 class="slim-pagetitle">{{$header_text}}</h6>
        </div><!-- slim-pageheader -->

        <div class="section-wrapper">
            <?php if(havePermission("admin/categories","add_action")): ?>
                <label class="section-title">
                    <a class="btn btn-primary mg-b-6" href="{{url("admin/categories/save")}}"> add new <i class="fa fa-plus"></i></a>
                </label>
            <?php endif; ?>
            <p class="mg-b-20 mg-sm-b-40"></p>

            <div class="table-wrapper">


                <form id="save_form" class="ajax_form" action="{{url("admin/categories/save/$cat_id")}}" method="POST" enctype="multipart/form-data">

                    <input type="hidden" class="parent_selected" value="{{($item_data->cat_parent_id ?? "")}}" >

                    @include("general_form_blocks.main_form")


                    {{csrf_field()}}

                    <div class="form-layout-footer">
                        <input id="submit" type="submit" value="save" class="btn btn-primary bd-0">
                    </div>

                </form>

            </div><!-- table-wrapper -->
        </div><!-- section-wrapper -->

    </div><!-- container -->
</div><!-- slim-mainpanel -->




