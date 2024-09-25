<?php

/**
 * 
 * Customize Theme 
 * - footer options
 */
add_action('customize_register', 'i8_footer_options');
function i8_footer_options($wp_customize)
{
    /**
     * Add Sections
     */
    $wp_customize->add_section('i8_theme_footer_setting', array(
        'title' => __('تنظیمات فوتر', 'i8_theme'),
        'priority'  => 60
    ));

    /**
     * Add Setting
     */
    $wp_customize->add_setting('i8_footer_copyright',  array('default' => '', 'transport' => 'refresh'));

    /**
     * Add Controls
     */
    $wp_customize->add_control('i8_footer_copyright', array(
        'type' => 'textarea',
        'section' => 'i8_theme_footer_setting',
        'settings' => 'i8_footer_copyright',
        'label' => __('متن کپی رایت', 'i8_theme'),
    ));
}
