<?php

/**
 * 
 * Customize Theme 
 * 
 */
add_action('customize_register', 'i8_customize_register_copy_write');
function i8_customize_register_copy_write($wp_customize)
{
    /**
     * Add Sections
     */
    $wp_customize->add_section('i8_theme_colors', array(
        'title' => __('تنظیمات رنگبندی', 'i8_theme'),
        'priority'  => 30
    ));

    /**
     * Add Setting
     */
    $wp_customize->add_setting('i8_light_primary_color',  array('default' => '#087DAF', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_dark_primary_color', array('default' => '#087DAF', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_light_secondary_color', array('default' => '#4A4A4A', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_dark_secondary_color', array('default' => '#f8f8f8', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_light_complete_color',  array('default' => '#f67902', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_dark_complete_color', array('default' => '#f67902', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_light_bg_color', array('default' => '#f8f8f8', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_dark_bg_color', array('default' => '#171c28', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_light_fg_color', array('default' => '#ffffff', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_dark_fg_color', array('default' => '#222740', 'transport' => 'refresh'));

    /**
     * Add Controls
     */
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'i8_light_primary_color', array(
        'label' => __('رنگ اصلی روز', 'i8_theme'), 'section' => 'i8_theme_colors', 'settings' => 'i8_light_primary_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'i8_dark_primary_color', array(
        'label' => __('رنگ اصلی شب', 'i8_theme'), 'section' => 'i8_theme_colors', 'settings' => 'i8_dark_primary_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'i8_light_secondary_color', array(
        'label' => __('رنگ ثانویه روز', 'i8_theme'), 'section' => 'i8_theme_colors', 'settings' => 'i8_light_secondary_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'i8_dark_secondary_color', array(
        'label' => __('رنگ ثانویه شب ', 'i8_theme'), 'section' => 'i8_theme_colors', 'settings' => 'i8_dark_secondary_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'i8_light_complete_color', array(
        'label' => __('رنگ مکمل روز ', 'i8_theme'), 'section' => 'i8_theme_colors', 'settings' => 'i8_light_complete_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'i8_dark_complete_color', array(
        'label' => __('رنگ مکمل شب ', 'i8_theme'), 'section' => 'i8_theme_colors', 'settings' => 'i8_dark_complete_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'i8_light_bg_color', array(
        'label' => __('رنگ پس زمینه روز', 'i8_theme'), 'section' => 'i8_theme_colors', 'settings' => 'i8_light_bg_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'i8_dark_bg_color', array(
        'label' => __('رنگ پس زمینه شب', 'i8_theme'), 'section' => 'i8_theme_colors', 'settings' => 'i8_dark_bg_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'i8_light_fg_color', array(
        'label' => __('رنگ روکار روز', 'i8_theme'), 'section' => 'i8_theme_colors', 'settings' => 'i8_light_fg_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'i8_dark_fg_color', array(
        'label' => __('رنگ روکار شب ', 'i8_theme'), 'section' => 'i8_theme_colors', 'settings' => 'i8_dark_fg_color'
    )));
}
