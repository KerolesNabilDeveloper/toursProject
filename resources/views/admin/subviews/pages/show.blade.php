<div class="slim-mainpanel">
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("admin/dashboard")}}">dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">pages</li>
            </ol>
            <h6 class="slim-pagetitle">pages</h6>
        </div><!-- slim-pageheader -->

        <div class="section-wrapper">

            <?php if(havePermission("admin/pages","add_action")): ?>
                <label class="section-title">
                    <a class="btn btn-primary mg-b-6" href="{{url("admin/pages/save")}}"> Add new <i class="fa fa-plus"></i></a>
                </label>
            <?php endif; ?>

            <p class="mg-b-20 mg-sm-b-40"></p>

            <div class="table-wrapper">

                <?php if(is_array($results->all()) && count($results->all())): ?>

                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p"><span>#</span></th>
                            <th class="wd-15p"><span>Image</span></th>
                            <th class="wd-15p"><span>name</span></th>
                            <th class="wd-15p"><span>show in menu ?</span></th>
                            <th class="wd-15p"><span>sort</span></th>
                            <th class="wd-15p"><span>option</span></th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        <?php foreach ($results as $key => $item): ?>
                            <tr id="row{{$item->page_id}}" data-fieldname="page_order" data-itemid="<?= $item->page_id ?>" data-tablename="{{\App\models\pages_m::class}}">
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>
                                    <img src="{{get_image_from_json_obj($item->page_img_obj)}}" width="50" height="50">
                                </td>
                                <td>
                                    {{$item->page_title}}
                                </td>
                                <td>
                                    <?php
                                        echo generate_multi_accepters(
                                            $accepturl              = "",
                                            $item_obj               = $item,
                                            $item_primary_col       = "page_id",
                                            $accept_or_refuse_col   = "show_page_on_menu",
                                            $model                  = 'App\models\pages_m',
                                            $accepters_data         =
                                            [
                                                "0"     => "<i class='fa fa-times'></i>",
                                                "1"     => "<i class='fa fa-check'></i>",
                                            ]
                                        );
                                    ?>
                                </td>

                                <td>
                                    {{$item->page_order + 1}}
                                </td>

                                <td>

                                    <?php if(havePermission("admin/pages","edit_action")): ?>
                                        <a class="btn btn-primary mg-b-6" href="{{url("admin/pages/save/$item->page_id")}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    <?php endif; ?>


                                    <?php if(havePermission("admin/pages","delete_action")): ?>
                                        <a href='#confirmModal'
                                           data-toggle="modal"
                                           data-effect="effect-super-scaled"
                                           class="btn btn-danger mg-b-6 modal-effect confirm_remove_item"
                                           data-tablename="App\models\pages_m"
                                           data-deleteurl="{{url("/admin/pages/delete")}}"
                                           data-itemid="{{$item->page_id}}">
                                            <i class="fa fa-remove"></i>
                                        </a>
                                    <?php endif; ?>


                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>

                    @include("global_components.order_btn_action")

                <?php else : ?>

                    @include('global_components.no_results_found')

                <?php endif; ?>

            </div><!-- table-wrapper -->
        </div><!-- section-wrapper -->

    </div><!-- container -->
</div><!-- slim-mainpanel -->
