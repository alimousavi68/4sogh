<?php
function custom_logo_settings_section() {
    add_settings_section("custom_logo_section", "تنظیمات لوگو", null, "general");
    add_settings_field("custom_logo", "لوگو", "custom_logo_callback", "general", "custom_logo_section");
    register_setting("general", "custom_logo");
}

function custom_logo_callback() {
    $custom_logo = get_option("custom_logo");
    echo '<input type="file" name="custom_logo" id="custom_logo" value="' . $custom_logo . '" />';
}

add_action("admin_init", "custom_logo_settings_section");
