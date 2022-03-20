<?php
/** @var object $item_data  */
/** @var \App\form_builder\FormBuilder $builderObj  */
/** @var \Illuminate\Support\Collection $all_langs  */
?>

<?php if(count($builderObj->select_fields) > 0 || count($builderObj->normal_fields) > 0): ?>
<div class="row">
    <div class="col-md-12">
        <div class="section-wrapper mg-y-20">

            <label class="section-title">Main data</label>
            <p class="mg-b-20 mg-sm-b-40"></p>

            <div class="row">
                <?php
                echo save_select_fields_block(
                    $builderObj,
                    $item_data
                );
                ?>

                <?php
                echo save_normal_fields_block(
                    $builderObj,
                    $item_data
                );
                ?>
            </div>

        </div>
    </div>
</div>
<?php endif; ?>
