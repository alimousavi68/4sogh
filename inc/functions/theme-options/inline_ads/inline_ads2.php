<?php 
    /**
     * Add Sections
     */
    $wp_customize->add_section('i8_theme_inline_ads_section2', array(
        'title' => __('تبلیغ دوم', 'i8_theme'),
        'panel' => 'i8_inline_ads_i8_inline_ads_panel',
        'priority'  => 10
    ));

    /**
     * Add Setting
     */
    $wp_customize->add_setting('i8_inline_ads_i8_inline_ads2_status',  array('default' => '', 'transport' => 'postMessage', 'default' => 'disable'));
    $wp_customize->add_setting('i8_inline_ads_i8_inline_ads2_code',  array('default' => '', 'transport' => 'postMessage'));
    $wp_customize->add_setting('i8_inline_ads_i8_inline_ads2_insert_type',  array('default' => '', 'transport' => 'postMessage', 'default' => 'between'));
    $wp_customize->add_setting('i8_inline_ads_i8_inline_ads2_post_number',  array('default' => '', 'transport' => 'postMessage', 'default' => '5'));

    /**
     * Add Controls
     */
    $wp_customize->add_control('i8-inline-ads2-status', array(
        'type' => 'select',
        'section' => 'i8_theme_inline_ads_section2',
        'settings' => 'i8_inline_ads_i8_inline_ads2_status',
        'label' => __('وضعیت', 'i8_theme'),
        'choices' => array(
            'enable' => __('فعال', 'i8_theme'),
            'disable' => __('غیرفعال', 'i8_theme'),
        ),
    ));

    $wp_customize->add_control(new WP_Customize_Code_Editor_Control($wp_customize, 'i8-inline-ads2-code', array(
        'label' => __('', 'i8_theme'),
        'section' => 'i8_theme_inline_ads_section2',
        'settings' => 'i8_inline_ads_i8_inline_ads2_code',
        'theme' => 'dracula',
        'options' => array('lineNumbers' => true)
    )));

    $wp_customize->add_control('i8-inline-ads2-insert-type', array(
        'type' => 'select',
        'section' => 'i8_theme_inline_ads_section2',
        'settings' => 'i8_inline_ads_i8_inline_ads2_insert_type',
        'label' => __('نحوه درج در مطلب', 'i8_theme'),
        'choices' => array(
            'number' => __('شماره پاراگراف از مطلب', 'i8_theme'),
            'between' => __('میانه مطلب', 'i8_theme'),
            'third' => __('یک سوم مطلب', 'i8_theme'),
            'quarter' => __('یک چهارم مطلب', 'i8_theme'),
            'end' => __('انتهای مطلب', 'i8_theme'),
        ),
    ));

    $wp_customize->add_control('i8-inline-ads2-insert-post-number', array(
        'type' => 'number',
        'section' => 'i8_theme_inline_ads_section2',
        'settings' => 'i8_inline_ads_i8_inline_ads2_post_number',
        'label' => __('شماره پاراگراف مطلب', 'i8_theme'),
    ));
