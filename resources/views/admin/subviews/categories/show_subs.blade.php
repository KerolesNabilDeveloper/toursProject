<div class="slim-mainpanel">
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("admin/dashboard")}}">dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">categories</li>
            </ol>
            <h6 class="slim-pagetitle">categories</h6>
        </div><!-- slim-pageheader -->

        <div class="section-wrapper">

            <?php if(havePermission("admin/categories","add_action")): ?>
                <label class="section-title">
                    <a class="btn btn-primary mg-b-6" href="{{url("admin/categories/save?parent_id=".$_GET['parent_id'])}}">Add new<i class="fa fa-plus"></i></a>
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
                            <th class="wd-15p"><span>Name</span></th>
                            <th class="wd-15p"><span>Chlid</span></th>
                            <th class="wd-15p"><span>hidden?</span></th>
                            <th class="wd-15p"><span>Option</span></th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        <?php foreach ($results as $key => $item): ?>
                        <tr id="row{{$item->cat_id}}" data-fieldname="page_order" data-itemid="<?= $item->cat_id ?>" data-tablename="{{\App\models\categories_m::class}}">
                            <td>
                                {{$key+1}}
                            </td>
                            <td>
                                <img src="{{get_image_from_json_obj($item->cat_img_obj)}}" width="50" height="50">
                            </td>
                            <td>
                                {{$item->cat_name}}
                            </td>
                            <td>
                                <a class="btn btn-info"

                                   href="{{url('admin/categories/sub/tours?cat_id='.$item->cat_id)}}" >
                                    show tours
                                </a>
                            </td>
                            <td>
                                <?php
                                echo generate_multi_accepters(
                                    $accepturl              = "",
                                    $item_obj               = $item,
                                    $item_primary_col       = "cat_id",
                                    $accept_or_refuse_col   = "cat_is_active",
                                    $model                  = 'App\models\categories_m',
                                    $accepters_data         =
                                        [
                                            "1"     => "<i class='fa fa-times'></i>",
                                            "0"     => "<i class='fa fa-check'></i>",
                                        ]
                                );
                                ?>
                            </td>


                            <td>

                                <?php if(havePermission("admin/categories","edit_action")): ?>
                                <a class="btn btn-primary mg-b-6" href="{{url("admin/categories/save/$item->cat_id")}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <?php endif; ?>


                                <?php if(havePermission("admin/categories","delete_action")): ?>
                                <a href='#confirmModal'
                                   data-toggle="modal"
                                   data-effect="effect-super-scaled"
                                   class="btn btn-danger mg-b-6 modal-effect confirm_remove_item"
                                   data-tablename="App\models\pages_m"
                                   data-deleteurl="{{url("/admin/categories/delete")}}"
                                   data-itemid="{{$item->cat_id}}">
                                    <i class="fa fa-remove"></i>
                                </a>
                                <?php endif; ?>

                            </td>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>

                <?php else : ?>

                    @include('global_components.no_results_found')

                <?php endif; ?>

            </div><!-- table-wrapper -->
        </div><!-- section-wrapper -->

    </div><!-- container -->
</div><!-- slim-mainpanel -->
