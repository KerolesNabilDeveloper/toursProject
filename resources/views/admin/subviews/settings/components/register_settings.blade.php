<?php
/**
 * @var $settings array
 */
?>

<div class="form-layout">
    <div class="row mg-b-25">

        <?php


            echo
            generate_select_tags_v2([
                "field_name"              => "registration_required_verify",
                "label_name"              => "registration require verification?",
                "text"                    => ["yes", "no"],
                "values"                  => ["1", "0"],
                "selected_value"          => [getSettingsValue('registration_required_verify')],
                "grid"                    => "col-md-6",
            ]);
        ?>

    </div><!-- row -->


</div>
