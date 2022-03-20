<?php

    $header_text        = "اضف جديد";
    $page_id            = "";

    if (is_object($item_data)) {
        $header_text    = front_tf($item_data->page_title);
        $page_id        = $item_data->page_id;
    }

?>

<div class="slim-mainpanel">
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("admin/dashboard")}}">dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{url("admin/pages")}}">pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$header_text}}</li>
            </ol>
            <h6 class="slim-pagetitle">{{$header_text}}</h6>
        </div><!-- slim-pageheader -->

        <div class="section-wrapper">
            <?php if(havePermission("admin/pages","add_action")): ?>
                <label class="section-title">
                    <a class="btn btn-primary mg-b-6" href="{{url("admin/pages/save")}}"> Add new <i class="fa fa-plus"></i></a>
                </label>
            <?php endif; ?>
            <p class="mg-b-20 mg-sm-b-40"></p>

            <div class="table-wrapper">

                <form id="save_form" class="ajax_form" action="{{url("admin/pages/save/$page_id")}}" method="POST" enctype="multipart/form-data">

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




