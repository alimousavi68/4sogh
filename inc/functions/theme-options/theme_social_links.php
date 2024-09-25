<?php

/**
 * 
 * Customize Theme 
 * - social links
 */
add_action('customize_register', 'i8_social_links');
function i8_social_links($wp_customize)
{
    /**
     * Add Sections
     */
    $wp_customize->add_section('i8_theme_social_section', array(
        'title' => __('لینک شبکه های اجتماعی', 'i8_theme'),
        'priority'  => 60
    ));

    /**
     * Add Setting
     */
    $wp_customize->add_setting('i8_social_link_twitter',  array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_social_link_instagram',  array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_social_link_telegram',  array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_social_link_whatsapp',  array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_social_link_facebook',  array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_social_link_youtube',  array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_social_link_aparat',  array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_social_link_eitta',  array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_social_link_bale',  array('default' => '', 'transport' => 'refresh'));
    $wp_customize->add_setting('i8_social_link_rubika',  array('default' => '', 'transport' => 'refresh'));

    /**
     * Add Controls
     */
    $wp_customize->add_control('i8_social_links_twitter_control', array(
        'type' => 'input',
        'section'  => 'i8_theme_social_section',
        'settings' => 'i8_social_link_twitter' ,
        'label' => __('توییتر', 'i8_theme'),
    ));

    $wp_customize->add_control('i8_social_links_instagram_control', array(
        'type' => 'input',
        'section'  => 'i8_theme_social_section',
        'settings' => 'i8_social_link_instagram' ,
        'label' => __('ایسنتاگرام', 'i8_theme'),
    ));

    $wp_customize->add_control('i8_social_links_telegram_control', array(
        'type' => 'input',
        'section'  => 'i8_theme_social_section',
        'settings' => 'i8_social_link_telegram' ,
        'label' => __('تلگرام', 'i8_theme'),
    ));

    $wp_customize->add_control('i8_social_links_whatsapp_control', array(
        'type' => 'input',
        'section'  => 'i8_theme_social_section',
        'settings' => 'i8_social_link_whatsapp' ,
        'label' => __('واتساپ', 'i8_theme'),
    ));

    $wp_customize->add_control('i8_social_links_facebook_control', array(
        'type' => 'input',
        'section'  => 'i8_theme_social_section',
        'settings' => 'i8_social_link_facebook' ,
        'label' => __('فیس بوک', 'i8_theme'),
    ));

    $wp_customize->add_control('i8_social_links_youtube_control', array(
        'type' => 'input',
        'section'  => 'i8_theme_social_section',
        'settings' => 'i8_social_link_youtube' ,
        'label' => __('یوتیوب', 'i8_theme'),
    ));
    $wp_customize->add_control('i8_social_links_aparat_control', array(
        'type' => 'input',
        'section'  => 'i8_theme_social_section',
        'settings' => 'i8_social_link_aparat' ,
        'label' => __('آپارات', 'i8_theme'),
    ));
    $wp_customize->add_control('i8_social_links_eitta_control', array(
        'type' => 'input',
        'section'  => 'i8_theme_social_section',
        'settings' => 'i8_social_link_eitta' ,
        'label' => __('ایتا', 'i8_theme'),
    ));
    $wp_customize->add_control('i8_social_links_bale_control', array(
        'type' => 'input',
        'section'  => 'i8_theme_social_section',
        'settings' => 'i8_social_link_bale' ,
        'label' => __('بله', 'i8_theme'),
    ));
    $wp_customize->add_control('i8_social_links_rubika_control', array(
        'type' => 'input',
        'section'  => 'i8_theme_social_section',
        'settings' => 'i8_social_link_rubika' ,
        'label' => __('روبیکا', 'i8_theme'),
    ));
}
