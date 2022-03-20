<?php
/**
 * @var $settings array
 */
?>

<div class="form-layout">
    <div class="row mg-b-25">

        <?php

            $normal_tags = [
                "normal_user_hotels_margin",
                "normal_user_flights_margin",
                "agent_hotels_margin",
                "agent_flights_margin",
            ];

            $attrs = generate_default_array_inputs_html(
                $fields_name = $normal_tags,
                $data = "",
                $key_in_all_fields = "yes",
                $required = "required",
                $grid_default_value = 6
            );

            foreach ($normal_tags as $tag) {
                $attrs[3][$tag] = "number";
                $attrs[4][$tag] = getSettingsValue($tag);
            }

            $attrs = attrs_divider($attrs,7,[
                ["normal_user_hotels_margin"],
                ["normal_user_flights_margin",],

                ["agent_hotels_margin",],
                ["agent_flights_margin",],
            ]);


        ?>

        <?php foreach($normal_tags as $key=>$field): ?>

            <?php
                echo
                generate_select_tags_v2([
                    "field_name"     => "{$field}_type",
                    "label_name"     => capitalize_string("{$field}_type"),
                    "text"           => ['percent', 'value'],
                    "values"         => ['percent', 'value'],
                    "selected_value" => [getSettingsValue("{$field}_type")],
                    "class"          => "form-control",
                    "grid"           => "col-md-6",
                ]);

                echo generate_inputs_html_take_attrs($attrs[$key]);
            ?>
        <?php endforeach; ?>


        <?php
            $normal_tags = [
                "agent_cancellation_fees_for_hotels",
                "agent_cancellation_fees_for_flights",

                "agent_margin_limit_percentage_for_sub_agents_for_hotels",
                "agent_margin_limit_percentage_for_sub_agents_for_flights",

            ];

            $attrs = generate_default_array_inputs_html(
                $fields_name = $normal_tags,
                $data = "",
                $key_in_all_fields = "yes",
                $required = "required",
                $grid_default_value = 6
            );

            foreach ($normal_tags as $tag) {
                $attrs[3][$tag] = "number";
                $attrs[4][$tag] = getSettingsValue($tag);
            }

            echo generate_inputs_html_take_attrs($attrs);

        ?>

    </div><!-- row -->


</div>
