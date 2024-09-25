<?php

/**
 * 
 * Customize Theme 
 * - search options
 */
add_action('customize_register', 'i8_search_options');
function i8_search_options($wp_customize)
{
    /**
     * Add Sections
     */
    $wp_customize->add_section('i8_theme_search_setting', array(
        'title' => __('تنظیمات جستجو', 'i8_theme'),
        'priority'  => 60
    ));

    /**
     * Add Setting
     */
    $wp_customize->add_setting('i8_search_ignore_category',  array('default' => '', 'transport' => 'postmessage'));

    $categories = get_categories(array('hide_empty'=>false));
    foreach ($categories as $category) {
        $cat[$category->term_id] = $category->cat_name;
    }

    /**
     * Add Controls
     */
    // ایجاد کنترل چک‌باکس چندانتخابی
    $wp_customize->add_control('selected_colors', array(
        'type' => 'select', 
        'section' => 'i8_theme_search_setting', 
        'label' => __('مخفی سازی این دسته بندی', 'your-theme'),
        'settings' => 'i8_search_ignore_category',
        'description' => __('با انتخاب این دسته بندی میتوانید پست های این مطلب را از جستجوی وردپرس مخفی نمایید', 'your-theme'),
        'choices' => $cat
    ));
}

function exclude_category_from_search($query) {
    if ($query->is_search && !is_admin()) {
        $excluded_category_id = get_theme_mod( 'i8_search_ignore_category' ); 

        $query->set('category__not_in', array($excluded_category_id));
    }
}
add_action('pre_get_posts', 'exclude_category_from_search');
