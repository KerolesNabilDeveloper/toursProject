<div class="slim-mainpanel">
    <div class="container">
        <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("admin/dashboard")}}">dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">tours</li>
            </ol>
            <h6 class="slim-pagetitle">tours</h6>
        </div><!-- slim-pageheader -->

        <div class="section-wrapper">

            <?php if(havePermission("admin/tours","add_action")): ?>
                <label class="section-title">
                    <a class="btn btn-primary mg-b-6" href="{{url("admin/tours/save")}}"> Add new <i class="fa fa-plus"></i></a>
                </label>
            <?php endif; ?>

            <p class="mg-b-20 mg-sm-b-40"></p>

            <div class="table-wrapper">

                <?php if(is_array($results->all()) && count($results->all())): ?>

                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p"><span>#</span></th>
                            <th class="wd-15p"><span>image</span></th>
                            <th class="wd-15p"><span>name</span></th>
                            <th class="wd-15p"><span>sort</span></th>
                            <th class="wd-15p"><span>option</span></th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        <?php foreach ($results as $key => $item): ?>
                            <tr id="row{{$item->id}}" data-fieldname="tour_sort" data-itemid="<?= $item->id ?>" data-tablename="{{\App\models\tours_m::class}}">
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>
                                    <img src="{{get_image_from_json_obj($item->tour_main_img_obj)}}" width="50" height="50">
                                </td>
                                <td>
                                    {{$item->tour_name}}
                                </td>
                                <td>
                                    {{$item->tour_sort + 1}}
                                </td>

                                <td>

                                    <?php if(havePermission("admin/tours","edit_action")): ?>
                                        <a class="btn btn-primary mg-b-6" href="{{url("admin/tours/save/$item->id")}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    <?php endif; ?>


                                    <?php if(havePermission("admin/tours","delete_action")): ?>
                                        <a href='#confirmModal'
                                           data-toggle="modal"
                                           data-effect="effect-super-scaled"
                                           class="btn btn-danger mg-b-6 modal-effect confirm_remove_item"
                                           data-tablename="App\models\pages_m"
                                           data-deleteurl="{{url("/admin/tours/delete")}}"
                                           data-itemid="{{$item->id}}">
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
