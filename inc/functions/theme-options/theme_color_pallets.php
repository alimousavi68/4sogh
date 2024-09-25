<?php
/**
 * 
 * Customize Theme Color Pallets
 * 
 */
add_action('customize_register', 'i8_customize_register');
function i8_customize_register($wp_customize)
{
    /**
     * Add Panel
     */
    $wp_customize->add_panel('i8_theme_colors_panel', array(
        'title'     => __('تنظیمات رنگبندی', 'i8_theme'),
        'priority'  => 20
    ));

    /**
     * Add Sections
     */
    $wp_customize->add_section('i8_theme_colors_section', array(
        'title'     => __('عمومی', 'i8_theme'),
        'panel'     => 'i8_theme_colors_panel',
        'priority'  => 30
    ));

    /**
     * Add Controls
     */
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'i8_primary_color_control', array(
        'label' => __('رنگ اصلی قالب', 'i8_theme'),
        'section' => 'i8_theme_colors_section',
        'settings' => 'i8_primary_color'
    )));

    /**
     * Add Setting
     */
    $wp_customize->add_setting('i8_primary_color', array(
        'default' => '#000',
        'transport' => 'refresh'
    ));
}

/**
 * Add Selected Setting Style To theme Headers
 *
 * 
 */
function i8_add_color_pallets_style_theme_head()
{
    //get retrieve Color Setting for Set
    $i8_light_primary_color   = get_theme_mod('i8_light_primary_color');
    $i8_dark_primary_color    = get_theme_mod('i8_dark_primary_color');
    $i8_light_secondary_color = get_theme_mod('i8_light_secondary_color');
    $i8_dark_secondary_color  = get_theme_mod('i8_dark_secondary_color');
    $i8_light_complete_color  = get_theme_mod('i8_light_complete_color');
    $i8_dark_complete_color   = get_theme_mod('i8_dark_complete_color');
    $i8_light_bg_color        = get_theme_mod('i8_light_bg_color');
    $i8_dark_bg_color         = get_theme_mod('i8_dark_bg_color');
    $i8_light_fg_color        = get_theme_mod('i8_light_fg_color');
    $i8_dark_fg_color         = get_theme_mod('i8_dark_fg_color');
?>
<style type="text/css">
    :root {
        --i8-light-primary        : <?php echo $i8_light_primary_color;   ?>;
        --i8-dark-primary         : <?php echo $i8_dark_primary_color;   ?>;
        --i8-light-secondary      : <?php echo $i8_light_secondary_color; ?>;
        --i8-dark-secondary       : <?php echo $i8_dark_secondary_color; ?>;
        --i8-light-complete-color : <?php echo $i8_light_complete_color; ?>;
        --i8-dark-complete-color  : <?php echo $i8_dark_complete_color; ?>;
        --i8-light-bg-color       : <?php echo $i8_light_bg_color; ?>;
        --i8-dark-bg-color        : <?php echo $i8_dark_bg_color; ?>;
        --i8-light-fg-color       : <?php echo $i8_light_fg_color; ?>;
        --i8-dark-fg-color        : <?php echo $i8_dark_fg_color; ?>;
        }
    </style>
<?php
}
add_action('wp_head', 'i8_add_color_pallets_style_theme_head');
