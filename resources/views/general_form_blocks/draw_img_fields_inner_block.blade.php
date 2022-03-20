<?php
    /** @var App\form_builder\FormBuilder $builder */
    /** @var Eloquent $data_object */
?>

<?php
    foreach ($builder->img_fields as $field=>$attrs){

        $display_label = $attrs["display_label"];
        if(
            isset($attrs["height"])&&$attrs["height"]>0&&
            isset($attrs["width"])&&$attrs["width"]>0
        ){
            $display_label .= " - " ." العرض  * الطول " . "  ( ".$attrs["height"]." * ".$attrs["width"]." ) ";
        }

        echo generate_img_tags_for_form(
            $filed_name=$field."_file",
            $filed_label=$field."_file",
            $required_field="",
            $checkbox_field_name=$field."_file_checkbox",
            $need_alt_title=(isset($attrs["need_alt_title"])?$attrs["need_alt_title"]:"no"),
            $required_alt_title="",
            $old_path_value="",
            $old_title_value="",
            $old_alt_value="",
            $recomended_size="",
            $disalbed="",
            $displayed_img_width="50",
            $display_label,
            isset($data_object->{$field})?$data_object->{$field}:""
        );
    }
?>

<?php if(count($builder->slider_fields)): ?>
    <div class="col-md-12">
        <hr class="my_hr">
    </div>
<?php endif; ?>

<div class="col-md-12">

<?php
    foreach ($builder->slider_fields as $field=>$attrs){

        if(
            isset($attrs["height"])&&$attrs["height"]>0&&
            isset($attrs["width"])&&$attrs["width"]>0
        ){
            $attrs["display_label"] .= " "." width * height (".$attrs["height"]." * ".$attrs["width"].")";
        }

        if(isset($attrs["imgs_limit"])&&$attrs["imgs_limit"]>0){
            $attrs["display_label"] .= " - "."You are allowed to upload as many photos as possible "."(".$attrs["imgs_limit"].")";
        }


        echo generate_slider_imgs_tags(
            $slider_photos=isset($data_object->{$field})?$data_object->{$field}:"",
            $field_name=$field."_file",
            $field_label=$attrs["display_label"],
            $field_id=$field."_file_id",
            $accept="image/*",
            $need_alt_title=(isset($attrs["need_alt_title"])?$attrs["need_alt_title"]:"no"),
            $need_alt_title=(isset($attrs["need_alt_title"])?$attrs["need_alt_title"]:"no"),
            $additional_inputs_arr=$attrs["additional_inputs_arr"] ?? [],
            $show_as_link=false,
            $add_item_label="Add",
            $without_attachment=true
        );

        echo "<hr class='my_hr'>";
    }

?>
</div>
