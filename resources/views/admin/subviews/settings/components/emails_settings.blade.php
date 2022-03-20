<div class="form-layout">
    <div class="row mg-b-25 sms_emails_settings_div">

        <?php
            echo
            generate_select_tags_v2([
                "field_name"     => "mail_type",
                "label_name"     => "Mailing System",
                "text"           => ["Mail", "SMTP"],
                "values"         => ["mail", "smtp"],
                "selected_value" => [getSettingsValue('mail_type')],
                "class"          => "form-control change_mail_type",
                "grid"           => "col-md-6 mail_type_div",
            ]);
        ?>

        <div class="col email_input_div">
            <?php
                $normal_tags = [
                    "system_sender_email"
                ];

                $attrs = generate_default_array_inputs_html(
                    $fields_name = $normal_tags,
                    $data = "",
                    $key_in_all_fields = "yes",
                    $required = "",
                    $grid_default_value = 12
                );


                $attrs[3]["system_sender_email"] = "email";
                $attrs[4]["system_sender_email"] = getSettingsValue('system_sender_email');

                echo generate_inputs_html_take_attrs($attrs);
            ?>
        </div>
    </div><!-- row -->


    <div class="smtp_settings_div">
        <h3 class="alert alert-info"><b>SMTP Settings</b></h3>
        <div class="row mg-b-25">
            <?php

                $normal_tags = [
                    "smtp_port", "smtp_host", "smtp_user", "smtp_pass"
                ];

                $attrs = generate_default_array_inputs_html(
                    $fields_name = $normal_tags,
                    $data = "",
                    $key_in_all_fields = "yes",
                    $required = "",
                    $grid_default_value = 6
                );

                $attrs[0]["smtp_pass"] = ' smtp pass (if you want to change it) ';

                foreach ($normal_tags as $tag){
                    $attrs[4][$tag] = getSettingsValue($tag);
                }

                $attrs[4]["smtp_pass"] = "";

                echo generate_inputs_html_take_attrs($attrs);

            ?>
        </div>
    </div>

</div>
