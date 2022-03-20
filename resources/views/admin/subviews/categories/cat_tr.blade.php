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

           href="{{url('admin/categories/subs?parent_id='.$item->cat_id)}}" >
            subs categories
        </a>
    </td>
    <td>
        <?php
                                                echo generate_multi_accepters(
                                                    $accepturl              = "",
                                                    $item_obj               = $item,
                                                    $item_primary_col       = "cat_id",
                                                    $accept_or_refuse_col   = "show_in_menu",
                                                    $model                  = 'App\models\categories_m',
                                                    $accepters_data         =
                                                    [
                                                        "0"     => "<i class='fa fa-times'></i>",
                                                        "1"     => "<i class='fa fa-check'></i>",
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